<?php

namespace App\Http\Controllers;

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
        // Ambil semua categories untuk search dropdown
        $categories = FoodCategories::all();

        // PERBAIKAN: initialize $foodPlaces dengan LengthAwarePaginator yang benar
        $foodPlaces = new LengthAwarePaginator(
            collect(), // empty collection
            0, // total
            12, // per page
            Paginator::resolveCurrentPage(), // current page
            [
                'path' => $request->url(),
                'pageName' => 'page',
            ]
        );

        // Jika ada parameter search atau category, lakukan pencarian
        if ($request->filled('search') || $request->filled('category')) {
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

            // Update $foodPlaces dengan hasil pencarian
            $foodPlaces = $query->paginate(12)->withQueryString();
        }

        // Ambil featured food places untuk section rekomendasi
        $featuredPlaces = FoodPlace::with('category')
            ->latest()
            ->limit(6)
            ->get();

        // PASTIKAN semua variabel selalu dikirim
        return view('layouts.home', compact('categories', 'foodPlaces', 'featuredPlaces'));
    }
}
