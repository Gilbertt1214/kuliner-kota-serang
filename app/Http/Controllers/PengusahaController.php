<?php

namespace App\Http\Controllers;

use App\Models\FoodPlace;
use App\Models\FoodCategories;
use App\Models\FoodPlaceImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class PengusahaController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
    // Remove problematic role middleware - role check will be done in routes
  }

  public function index()
  {

    if (Auth::user()->role !== 'pengusaha') {
      abort(403, 'Unauthorized');
    }

    $user = Auth::user();
    $foodPlaces = FoodPlace::where('user_id', $user->id)
      ->with(['category', 'images', 'reviews'])
      ->orderBy('created_at', 'desc')
      ->paginate(10);

    $stats = [
      'total' => $foodPlaces->total(),
      'pending' => FoodPlace::where('user_id', $user->id)->where('status', 'pending')->count(),
      'active' => FoodPlace::where('user_id', $user->id)->where('status', 'active')->count(),
      'rejected' => FoodPlace::where('user_id', $user->id)->where('status', 'rejected')->count(),
    ];

    $categories = FoodCategories::with('foodPlaces')->withCount('foodPlaces')->get();

    return view('pengusaha.food-places.index', compact('foodPlaces', 'stats', 'categories'));
  }

  public function create()
  {
    if (Auth::user()->role !== 'pengusaha') {
      abort(403, 'Unauthorized');
    }
    $categories = FoodCategories::all();
    return view('pengusaha.food-places.create', compact('categories'));
  }

  public function store(Request $request)
  {
    dd($request->all());
    try {
      $validated = $request->validate([
        'title' => 'required|string|max:255',
        'food_category_id' => 'required|exists:food_categories,id',
        'min_price' => 'required|numeric|min:0',
        'max_price' => 'required|numeric|gt:min_price',
        'location' => 'required|string|max:500',
        'description' => 'required|string',
        'source_location' => 'nullable|url',
        'images' => 'required|array|max:5',
        'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
      ]);

      // Create food place with pending status
      $foodPlace = FoodPlace::create([
        'title' => $validated['title'],
        'food_category_id' => $validated['food_category_id'],
        'min_price' => $validated['min_price'],
        'max_price' => $validated['max_price'],
        'location' => $validated['location'],
        'description' => $validated['description'],
        'source_location' => $validated['source_location'],
        'user_id' => Auth::id(),
        'status' => 'pending', // Always pending for pengusaha submissions
      ]);

      // Handle image uploads
      if ($request->hasFile('images')) {
        foreach ($request->file('images') as $index => $image) {
          $path = $image->store('food-places', 'public');

          FoodPlaceImage::create([
            'food_place_id' => $foodPlace->id,
            'image_path' => $path,
            'type' => 'business', // Use 'business' type to match existing structure
          ]);
        }
      }

      if ($request->wantsJson()) {
        return response()->json([
          'success' => true,
          'message' => 'Tempat kuliner berhasil didaftarkan! Menunggu persetujuan admin.',
          'redirect' => route('pengusaha.dashboard')
        ]);
      }

      return redirect()->route('pengusaha.dashboard')
        ->with('success', 'Tempat kuliner berhasil didaftarkan! Menunggu persetujuan admin.');
    } catch (\Exception $e) {
      Log::error('Error creating food place: ' . $e->getMessage());

      if ($request->wantsJson()) {
        return response()->json([
          'success' => false,
          'message' => 'Terjadi kesalahan saat mendaftarkan tempat kuliner.'
        ], 500);
      }

      return redirect()->back()
        ->with('error', 'Terjadi kesalahan saat mendaftarkan tempat kuliner.')
        ->withInput();
    }
  }

  public function show($id)
  {
    $foodPlace = FoodPlace::with(['images', 'category', 'reviews'])->findOrFail($id);
    // Check if current user has already reviewed this place

    $categories = FoodCategories::with('foodPlaces')->withCount('foodPlaces')->get();

    $userReview = null;
    if (Auth::check()) {
      $userReview = $foodPlace->reviews()
        ->where('user_id', Auth::id())
        ->first();
    }
    // return view('layouts.food-place-detail', compact('foodPlace', 'userReview', 'categories'));
    // $foodPlace = FoodPlace::where('user_id', Auth::id())
    //   ->with(['category', 'images', 'reviews.user'])
    //   ->findOrFail($id);

    return view('pengusaha.food-places.show', compact('foodPlace'));
  }

  public function edit($id)
  {
    $foodPlace = FoodPlace::where('user_id', Auth::id())->findOrFail($id);

    // // Only allow editing if status is not active (to prevent changes to approved places)
    // if ($foodPlace->status === 'active') {
    //   return redirect()->route('pengusaha.dashboard')
    //     ->with('warning', 'Tempat kuliner yang sudah aktif tidak dapat diedit. Hubungi admin jika perlu perubahan.');
    // }

    $categories = FoodCategories::all();
    return view('pengusaha.food-places.edit', compact('foodPlace', 'categories'));
  }

  public function update(Request $request, $id)
  {
    try {
      $foodPlace = FoodPlace::where('user_id', Auth::id())->findOrFail($id);

      // Only allow editing if not active
      if ($foodPlace->status === 'active') {
        return redirect()->route('pengusaha.dashboard')
          ->with('error', 'Tempat kuliner yang sudah aktif tidak dapat diedit.');
      }

      $validated = $request->validate([
        'title' => 'required|string|max:255',
        'food_category_id' => 'required|exists:food_categories,id',
        'min_price' => 'required|numeric|min:0',
        'max_price' => 'required|numeric|gt:min_price',
        'location' => 'required|string|max:500',
        'description' => 'required|string',
        'source_location' => 'nullable|url',
        'images' => 'nullable|array|max:5',
        'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        'remove_images' => 'nullable|array',
        'remove_images.*' => 'exists:food_place_images,id',
      ]);

      // Update food place
      $foodPlace->update([
        'title' => $validated['title'],
        'food_category_id' => $validated['food_category_id'],
        'min_price' => $validated['min_price'],
        'max_price' => $validated['max_price'],
        'location' => $validated['location'],
        'description' => $validated['description'],
        'source_location' => $validated['source_location'],
        'status' => 'pending', // Reset to pending after edit
      ]);

      // Remove selected images
      if ($request->has('remove_images')) {
        $imagesToRemove = FoodPlaceImage::whereIn('id', $request->remove_images)
          ->where('food_place_id', $foodPlace->id)
          ->get();

        foreach ($imagesToRemove as $image) {
          Storage::disk('public')->delete($image->image_path);
          $image->delete();
        }
      }

      // Add new images
      if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
          $path = $image->store('food-places', 'public');

          FoodPlaceImage::create([
            'food_place_id' => $foodPlace->id,
            'image_path' => $path,
            'type' => 'business', // Use 'business' type
          ]);
        }
      }

      // Ensure we have at least one image
      $imageCount = $foodPlace->images()->count();
      if ($imageCount === 0) {
        return redirect()->back()
          ->with('error', 'Tempat kuliner harus memiliki minimal satu gambar.')
          ->withInput();
      }

      return redirect()->route('pengusaha.dashboard')
        ->with('success', 'Tempat kuliner berhasil diperbarui! Menunggu persetujuan admin kembali.');
    } catch (\Exception $e) {
      Log::error('Error updating food place: ' . $e->getMessage());

      return redirect()->back()
        ->with('error', 'Terjadi kesalahan saat memperbarui tempat kuliner.')
        ->withInput();
    }
  }

  public function destroy($id)
  {
    try {
      $foodPlace = FoodPlace::where('user_id', Auth::id())->findOrFail($id);

      // Delete images from storage
      foreach ($foodPlace->images as $image) {
        Storage::disk('public')->delete($image->image_path);
        $image->delete();
      }

      // Delete food place
      $foodPlace->delete();

      if (request()->wantsJson()) {
        return response()->json([
          'success' => true,
          'message' => 'Tempat kuliner berhasil dihapus.'
        ]);
      }

      return redirect()->route('pengusaha.dashboard')
        ->with('success', 'Tempat kuliner berhasil dihapus.');
    } catch (\Exception $e) {
      Log::error('Error deleting food place: ' . $e->getMessage());

      if (request()->wantsJson()) {
        return response()->json([
          'success' => false,
          'message' => 'Terjadi kesalahan saat menghapus tempat kuliner.'
        ], 500);
      }

      return redirect()->back()
        ->with('error', 'Terjadi kesalahan saat menghapus tempat kuliner.');
    }
  }
}
