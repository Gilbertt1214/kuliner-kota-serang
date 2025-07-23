<?php

namespace App\Http\Controllers;


use App\Models\FoodPlace;
use App\Models\FoodCategories;
use App\Models\Review;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application homepage.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Get featured food places (latest 6 active food places with their images and reviews)
        $foodPlaces = FoodPlace::with(['images', 'reviews', 'category'])
            ->latest()
            ->limit(6)
            ->get();

        // Get recent reviews for testimonials or stats
        $reviews = Review::with(['foodPlace', 'user'])
            ->latest()
            ->limit(5)
            ->get();

        // Get all categories with food places count
        $categories = FoodCategories::withCount('foodPlaces')
            ->get();

        return view('layouts.home', compact('foodPlaces', 'reviews', 'categories'));
    }
}
