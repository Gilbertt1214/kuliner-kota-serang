<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FoodPlace;
use App\Models\FoodCategories;

class FoodSearchController extends Controller
{
    /**
     * Display search results for food places
     */
    public function index(Request $request)
    {
        // Ambil semua kategori untuk dropdown
        $categories = FoodCategories::all();

        // Query dasar untuk food places dengan eager loading
        $query = FoodPlace::with('category');

        // Filter berdasarkan pencarian teks
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('description', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('address', 'LIKE', "%{$searchTerm}%");
            });
        }

        // Filter berdasarkan kategori
        if ($request->filled('category') && $request->category != '') {
            $query->where('food_category_id', $request->category);
        }

        // Filter berdasarkan lokasi (jika ada)
        if ($request->filled('location')) {
            $location = $request->location;
            $query->where('address', 'LIKE', "%{$location}%");
        }

        // Ambil hasil dengan pagination
        $foodPlaces = $query->paginate(12)->withQueryString();
        
        return view('layouts.home', compact('foodPlaces', 'categories'));
    }

    /**
     * AJAX search for autocomplete (optional)
     */
    public function ajaxSearch(Request $request)
    {
        $query = FoodPlace::with('category');

        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('description', 'LIKE', "%{$searchTerm}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('food_category_id', $request->category);
        }

        $foodPlaces = $query->limit(10)->get();

        return response()->json($foodPlaces);
    }
}
