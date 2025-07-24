<?php

namespace App\Http\Controllers;

use App\Models\FoodPlace;
use App\Models\FoodCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class AdminFoodPlaceController extends Controller
{
    public function index(Request $request)
    {
        $query = FoodPlace::with([
            'category',
            'reviews.user',
            'images',
            'user'
        ])
            ->whereHas('user', function ($q) {
                $q->where('role', 'pengusaha');
            })
            ->withCount('reviews')
            ->withAvg('reviews as average_rating', 'rating')
            ->orderBy('created_at', 'desc');

        // Filter by category
        if ($request->filled('category')) {
            $query->where('food_category_id', $request->category);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by rating
        if ($request->filled('rating')) {
            $rating = $request->rating;
            if (str_contains($rating, '+')) {
                $minRating = (int) str_replace('+', '', $rating);
                $query->having('average_rating', '>=', $minRating);
            } else {
                $query->having('average_rating', '>=', $rating)
                    ->having('average_rating', '<', $rating + 1);
            }
        }

        $foodPlaces = $query->paginate(10);

        return view('admin.food-places.index', [
            'foodPlaces' => $foodPlaces,
            'categories' => FoodCategories::all(),
            'selectedCategory' => $request->category,
            'selectedRating' => $request->rating,
            'selectedStatus' => $request->status,
        ]);
    }

    public function create()
    {
        return view('admin.food-places.create', [
            'categories' => FoodCategories::all()
        ]);
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'food_category_id' => 'required|exists:food_categories,id',
                'min_price' => 'required|numeric|min:0',
                'max_price' => 'required|numeric|min:0|gte:min_price',
                'location' => 'required|string|max:255',
                'source_location' => 'nullable|url',
                'images' => 'required|array|max:5',
                'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:1024', // Reduced to 1MB
            ]);

            // Check if max price is greater than min price
            if ($validated['max_price'] <= $validated['min_price']) {
                return redirect()->back()
                    ->with('error', 'Harga maksimal harus lebih besar dari harga minimal')
                    ->withInput();
            }

            // Check if images are uploaded
            if (!$request->hasFile('images')) {
                return redirect()->back()
                    ->with('error', 'Silakan upload minimal satu gambar')
                    ->withInput();
            }

            // Check image count
            if (count($request->file('images')) > 5) {
                return redirect()->back()
                    ->with('error', 'Maksimal 5 gambar yang dapat diupload')
                    ->withInput();
            }

            // Create food place
            $foodPlace = FoodPlace::create([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'food_category_id' => $validated['food_category_id'],
                'min_price' => $validated['min_price'],
                'max_price' => $validated['max_price'],
                'location' => $validated['location'],
                'source_location' => $validated['source_location'],
                'user_id' => Auth::id(),
            ]);

            // Handle image upload
            foreach ($request->file('images') as $image) {
                if ($image->isValid()) {
                    $path = $image->store('public/food-places');
                    $foodPlace->images()->create([
                        'image_path' => str_replace('public/', '', $path)
                    ]);
                }
            }

            return redirect()->route('admin.food-places.index')
                ->with('success', 'Tempat makan berhasil ditambahkan!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('error', 'Silakan periksa data yang Anda masukkan');
        } catch (\Exception $e) {
            Log::error('Store error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage())
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
        return view('layouts.food-place-detail', compact('foodPlace', 'userReview', 'categories'));
    }

    public function edit($id)
    {
        $foodPlace = FoodPlace::findOrFail($id);
        $categories = FoodCategories::all();
        return view('admin.food-places.edit', compact('foodPlace', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $foodPlace = FoodPlace::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'food_category_id' => 'required|exists:food_categories,id',
            'min_price' => 'required|numeric|min:0',
            'max_price' => 'required|numeric|min:0|gte:min_price',
            'location' => 'required|string|max:255',
            'source_location' => 'nullable|url|max:255',
            'images' => 'sometimes|array|max:5',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:5120',
            'delete_images' => 'sometimes|array',
        ]);

        $foodPlace->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'food_category_id' => $validated['food_category_id'],
            'min_price' => $validated['min_price'],
            'max_price' => $validated['max_price'],
            'location' => $validated['location'],
            'source_location' => $validated['source_location'],
        ]);

        if ($request->has('delete_images')) {
            foreach ($request->delete_images as $imageId) {
                $image = $foodPlace->images()->find($imageId);
                if ($image) {
                    Storage::delete('public/' . $image->image_path);
                    $image->delete();
                }
            }
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('public/food-places');
                $foodPlace->images()->create([
                    'image_path' => str_replace('public/', '', $path)
                ]);
            }
        }

        return redirect()->route('admin.food-places.index')
            ->with('success', 'Tempat makan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        try {
            $foodPlace = FoodPlace::findOrFail($id);

            // Delete all images first
            foreach ($foodPlace->images as $image) {
                Storage::delete('public/' . $image->image_path);
                $image->delete();
            }

            // Delete all reviews
            $foodPlace->reviews()->delete();

            // Then delete the food place
            $foodPlace->delete();

            if (request()->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Food place deleted successfully!'
                ]);
            }

            return redirect()->route('admin.food-places.index')
                ->with('success', 'Food place deleted successfully!');
        } catch (\Exception $e) {
            Log::error('Delete error: ' . $e->getMessage());

            if (request()->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error deleting food place: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->back()
                ->with('error', 'Error deleting food place: ' . $e->getMessage());
        }
    }

    public function approve($id)
    {
        try {
            $foodPlace = FoodPlace::findOrFail($id);
            $foodPlace->update(['status' => 'active']);

            if (request()->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Food place approved successfully!'
                ]);
            }

            return redirect()->back()
                ->with('success', 'Food place approved successfully!');
        } catch (\Exception $e) {
            Log::error('Approve error: ' . $e->getMessage());

            if (request()->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error approving food place'
                ], 500);
            }

            return redirect()->back()
                ->with('error', 'Error approving food place');
        }
    }

    public function reject($id)
    {
        try {
            $foodPlace = FoodPlace::findOrFail($id);
            $foodPlace->update(['status' => 'rejected']);

            if (request()->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Food place rejected successfully!'
                ]);
            }

            return redirect()->back()
                ->with('success', 'Food place rejected successfully!');
        } catch (\Exception $e) {
            Log::error('Reject error: ' . $e->getMessage());

            if (request()->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error rejecting food place'
                ], 500);
            }

            return redirect()->back()
                ->with('error', 'Error rejecting food place');
        }
    }

    public function updateStatus(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'status' => 'required|in:active,inactive,pending,rejected'
            ]);

            $foodPlace = FoodPlace::findOrFail($id);
            $foodPlace->update(['status' => $validated['status']]);

            if (request()->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Status updated successfully!'
                ]);
            }

            return redirect()->back()
                ->with('success', 'Status updated successfully!');
        } catch (\Exception $e) {
            Log::error('Update status error: ' . $e->getMessage());

            if (request()->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error updating status'
                ], 500);
            }

            return redirect()->back()
                ->with('error', 'Error updating status');
        }
    }
}
