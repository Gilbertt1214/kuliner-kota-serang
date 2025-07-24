<?php

namespace App\Http\Controllers;

use App\Models\FoodCategories;
use App\Models\FoodPlace;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Auth;

class DashboardAdmin extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(IsAdmin::class);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = Auth::user();
        // total
        $foodPlaces  = FoodPlace::withCount('reviews')->get();
        $categories = FoodCategories::with('foodPlaces')->withCount('foodPlaces')->get();
        $reviews = Review::with('foodPlace')->withCount('foodPlace')->get();
        return view("admin.dashboard.index", compact('categories', 'foodPlaces', 'users', 'reviews'));
    }
}
