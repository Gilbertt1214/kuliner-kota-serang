<?php

namespace App\Http\Controllers;

use App\Models\FoodCategories;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    public function index()
    {
        $categories = FoodCategories::withCount('foodPlaces')
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
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category created successfully.');
    }

    public function edit($id)
    {
        $category = FoodCategories::findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:food_categories,name,' . $id,
        ]);

        $category = FoodCategories::findOrFail($id);
        $category->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        $category = FoodCategories::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category deleted successfully.');
    }
}
