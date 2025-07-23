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
        $categories = FoodCategories::with('foodPlaces')->withCount('foodPlaces')->get();        // Get recent reviews for testimonials or stats
        $reviews = Review::with(['foodPlace', 'user'])
            ->latest()
            ->limit(5)
            ->get();


        // PERBAIKAN: initialize $foodPlaces dengan LengthAwarePaginator yang benar
        $foodPlaces = FoodPlace::with('category')
            ->latest()
            ->paginate(12)
            ->withQueryString();


        // Jika ada parameter search atau category, lakukan pencarian
        if ($request->filled('search') || $request->filled('category')) {
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

            // Update $foodPlaces dengan hasil pencarian
            $foodPlaces = $query->paginate(12)->withQueryString();
        }

        // Ambil featured food places untuk section rekomendasi
        $featuredPlaces = FoodPlace::with('category')
            ->latest()
            ->limit(6)
            ->get();

        // PASTIKAN semua variabel selalu dikirim
        return view('layouts.home', compact('categories', 'foodPlaces', 'featuredPlaces', 'reviews'));
    }
}
