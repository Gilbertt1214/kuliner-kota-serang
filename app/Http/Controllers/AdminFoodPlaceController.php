<?php

namespace App\Http\Controllers;

use App\Models\FoodPlace;
use App\Models\FoodCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminFoodPlaceController extends Controller
{
    public function index(Request $request)
    {
        $query = FoodPlace::with(['category', 'reviews.user', 'images'])
            ->withCount('reviews')
            ->withAvg('reviews as average_rating', 'rating')
            ->orderBy('created_at', 'desc');

        // Filter by category
        if ($request->filled('category')) {
            $query->where('food_category_id', $request->category);
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

        return view('admin.food-places.index', [
            'foodPlaces' => $query->paginate(10),
            'categories' => FoodCategories::all(),
            'selectedCategory' => $request->category,
            'selectedRating' => $request->rating,
        ]);
    }
    public function save(Request $request)
{
    // Simpan data khusus
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'food_category_id' => 'required|exists:food_categories,id',
        'min_price' => 'required|numeric|min:0',
        'max_price' => 'required|numeric|min:0|gte:min_price',
        'location' => 'required|string|max:255',
        'source_location' => 'nullable|url|max:255',
        'images' => 'required|array|max:5',
        'images.*' => 'image|mimes:jpeg,png,jpg|max:5120', // 5MB
    ], [
        'max_price.gte' => 'Harga maksimum harus lebih besar atau sama dengan harga minimum.',
    ])->validate();
   
    // Validasi dan simpan sesuai kebutuhan
    $foodPlace = FoodPlace::create([
        'title' => $request->title,
        'description' => $request->description,
        'food_category_id' => $request->food_category_id,
        'min_price' => $request->min_price,
        'max_price' => $request->max_price,
        'location' => $request->location,
        'source_location' => $request->source_location,
        'status' => 'active',
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
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'food_category_id' => 'required|exists:food_categories,id',
            'min_price' => 'required|numeric|min:0',
            'max_price' => 'required|numeric|min:0|gte:min_price',
            'location' => 'required|string|max:255',
            'source_location' => 'nullable|url',
            'images' => 'required|array|max:5',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'max_price.gte' => 'Harga maksimum harus lebih besar atau sama dengan harga minimum.',
        ]);

        $foodPlace = FoodPlace::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'food_category_id' => $validated['food_category_id'],
            'min_price' => $validated['min_price'],
            'max_price' => $validated['max_price'],
            'location' => $validated['location'],
            'source_location' => $validated['source_location'],
            'status' => 'active',
        ]);

        // Handle image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('public/food-places');
                $foodPlace->images()->create([
                    'image_path' => str_replace('public/', '', $path)
                ]);
            }
        }

        return redirect()
            ->route('admin.food-places.index')
            ->with('success', 'Tempat makan berhasil ditambahkan!');
    }

    public function show($id)
    {
          $foodPlace = FoodPlace::with(['images', 'category', 'reviews'])->findOrFail($id);
        // $foodPlace->increment('views_count'); // Increment view count
        return view('layouts.food-place-detail', compact('foodPlace'));
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
        'price_min' => 'required|numeric|min:0',
        'price_max' => 'required|numeric|min:0|gte:price_min',
        'location' => 'required|string|max:255',
        'source_location' => 'nullable|url|max:255',
        'images' => 'sometimes|array|max:5',
        'images.*' => 'image|mimes:jpeg,png,jpg|max:5120', // 5MB
        'delete_images' => 'sometimes|array',
    ], [
        'price_max.gte' => 'Harga maksimum harus lebih besar atau sama dengan harga minimum.',
    ]);

      $foodPlace = FoodPlace::findOrFail($id);
    $foodPlace->update($validated);

    $foodPlace->update([
        'title' => $validated['title'],
        'description' => $validated['description'],
        'food_category_id' => $validated['food_category_id'],
        'min_price' => $validated['price_min'],
        'max_price' => $validated['price_max'],
        'location' => $validated['location'],
        'source_location' => $validated['source_location'],
    ]);

    // Handle deleted images
   if ($request->has('delete_images')) {
        foreach ($request->delete_images as $imageId) {
            $image = $foodPlace->images()->find($imageId);
            if ($image) {
                Storage::delete('public/' . $image->image_path);
                $image->delete();
            }
        }
    }

    // Handle new image uploads
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            $path = $image->store('public/food-places');
            $foodPlace->images()->create([
                'image_path' => str_replace('public/', '', $path)
            ]);
        }
    }

    return redirect()->route('admin.food-places.index')
                   ->with('success', 'Food place updated successfully!');
}

    public function destroy(FoodPlace $foodPlace)
    {
        // Delete associated images
        foreach ($foodPlace->images as $image) {
            Storage::delete('public/' . $image->image_path);
            $image->delete();
        }

        $foodPlace->delete();

        return redirect()
            ->route('admin.food-places.index')
            ->with('success', 'Tempat makan berhasil dihapus!');
    }
}
