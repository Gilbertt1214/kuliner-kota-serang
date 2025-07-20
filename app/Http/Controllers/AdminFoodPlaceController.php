<?php

namespace App\Http\Controllers;

use App\Models\FoodPlace;
use App\Models\FoodCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $foodPlaces = FoodPlace::with('owner')->get();
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
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
            'status' => 'required|in:active,inactive'
        ]);

        // Check if max price is greater than min price
        if ($validated['max_price'] <= $validated['min_price']) {
            return redirect()->back()
                ->with('error', 'Max price must be greater than min price')
                ->withInput();
        }

        // Check image count
        if (count($request->file('images')) > 5) {
            return redirect()->back()
                ->with('error', 'You can upload maximum 5 images')
                ->withInput();
        }

        $foodPlace = FoodPlace::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'food_category_id' => $validated['food_category_id'],
            'min_price' => $validated['min_price'],
            'max_price' => $validated['max_price'],
            'location' => $validated['location'],
            'source_location' => $validated['source_location'],
            'status' => $validated['status'] ?? 'active',
            'user_id' => auth()->id(),
        ]);

        // Handle image upload
        foreach ($request->file('images') as $image) {
            $path = $image->store('public/food-places');
            $foodPlace->images()->create([
                'image_path' => str_replace('public/', '', $path)
            ]);
        }

        return redirect()->route('admin.food-places.index')
            ->with('success', 'Food place added successfully!');

    } catch (\Illuminate\Validation\ValidationException $e) {
        return redirect()->back()
            ->withErrors($e->validator)
            ->withInput();
    } catch (\Exception $e) {
        return redirect()->back()
            ->with('error', 'Error creating food place: ' . $e->getMessage())
            ->withInput();
    }
}

    public function show($id)
    {
        $foodPlace = FoodPlace::with(['images', 'category', 'reviews'])->findOrFail($id);
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
            'images.*' => 'image|mimes:jpeg,png,jpg|max:5120',
            'delete_images' => 'sometimes|array',
        ]);

        $foodPlace->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'food_category_id' => $validated['food_category_id'],
            'min_price' => $validated['price_min'],
            'max_price' => $validated['price_max'],
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

   public function destroy( $id)
{
    try {
        // Delete all images first
        $foodPlace = FoodPlace::findOrFail($id);
        foreach ($foodPlace->images as $image) {
            Storage::delete('public/' . $image->image_path);
            $image->delete();
        }
        // Then delete the food place
        $foodPlace->delete();
        return redirect()->route('admin.food-places.index')
            ->with('success', 'Food place deleted successfully!');

    } catch (\Exception $e) {
        return redirect()->back()
            ->with('error', 'Error deleting food place: ' . $e->getMessage());
    }
}
}
