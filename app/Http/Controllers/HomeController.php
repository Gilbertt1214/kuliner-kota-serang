<?php

namespace App\Http\Controllers;


use App\Models\Review;
use Illuminate\Http\Request;
use App\Models\FoodCategories;
use App\Models\FoodPlace;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class HomeController extends Controller
{
    /**
     * Display the home page
     */
    public function index(Request $request)
    {
        // Ambil semua categories dengan jumlah food places untuk search dropdown
        $categories = FoodCategories::with('foodPlaces')->withCount('foodPlaces')->get();

        // Get recent reviews for testimonials or stats
        $reviews = Review::with(['foodPlace', 'user'])
            ->latest()
            ->limit(5)
            ->get();

        // Get featured food places untuk section rekomendasi (tidak terpengaruh pencarian)
        $featuredPlaces = FoodPlace::with('category')
            ->where('status', 'active')
            ->latest()
            ->limit(6)
            ->get();

        // Initialize empty foodPlaces untuk homepage (akan ditampilkan di featured places)
        $foodPlaces = collect(); // Empty collection untuk homepage

        // PASTIKAN semua variabel selalu dikirim
        return view('layouts.home', compact('categories', 'foodPlaces', 'featuredPlaces', 'reviews'));
    }
}
