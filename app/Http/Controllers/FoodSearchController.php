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
        // Ambil semua kategori untuk dropdown dengan count
        $categories = FoodCategories::withCount('foodPlaces')->get();

        // Query dasar untuk food places dengan eager loading
        $query = FoodPlace::with('category');

        // Filter berdasarkan pencarian teks
        if ($request->filled('search')) {
            $searchTerm = $request->get('search');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('description', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('location', 'LIKE', "%{$searchTerm}%");
            });
        }

        // Filter berdasarkan kategori
        if ($request->filled('category') && $request->get('category') != '') {
            $query->where('food_category_id', $request->get('category'));
        }

        // Filter berdasarkan lokasi (jika ada)
        if ($request->filled('location')) {
            $location = $request->get('location');
            $query->where('location', 'LIKE', "%{$location}%");
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
            $searchTerm = $request->get('search');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('description', 'LIKE', "%{$searchTerm}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('food_category_id', $request->get('category'));
        }

        $foodPlaces = $query->limit(10)->get();

        return response()->json($foodPlaces);
    }
}
