<?php

namespace App\Http\Controllers;

use App\Models\FoodCategories;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    public function index()
    {
        $categories = FoodCategories::with(['kategoriPengusaha'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.category.index', [
            'categories' => $categories,
        ]);
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:food_categories,name',
        ]);

        FoodCategories::create([
            'name' => $request->name,
            // Add other fields if needed
        ]);

        return redirect()->route('admin.categories.index')
                         ->with('success', 'Category created successfully.');
    }

   public function edit(FoodPlace $foodPlace)
{
    return response()->json([
        'success' => true,
        'data' => [
            'foodPlace' => $foodPlace->load('category', 'images'),
            'categories' => FoodCategories::all()
        ]
    ]);
}

public function update(Request $request, FoodPlace $foodPlace)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'food_category_id' => 'required|exists:food_categories,id',
        'price_min' => 'required|numeric|min:0',
        'price_max' => 'required|numeric|min:0|gte:price_min',
        'location' => 'required|string|max:255',
        'source_location' => 'nullable|url|max:255',
        'images' => 'sometimes|array|max:5',
        'images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        'deleted_images' => 'sometimes|array',
    ], [
        'price_max.gte' => 'Harga maksimum harus lebih besar atau sama dengan harga minimum.',
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

    // Handle deleted images
    if ($request->has('deleted_images')) {
        foreach ($request->deleted_images as $imageId) {
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

    return response()->json([
        'success' => true,
        'message' => 'Food place updated successfully!'
    ]);
}

    public function destroy($id)
    {
        $category = FoodCategories::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.categories.index')
                         ->with('success', 'Category deleted successfully.');
    }
}
