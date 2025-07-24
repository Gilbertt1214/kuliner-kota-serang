<?php

namespace App\Http\Controllers;

use App\Models\FoodCategories;
use App\Models\FoodPlace;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Auth;

class DashboardAdmin extends Controller
{
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
        // Get comprehensive data for dashboard
        $categories = FoodCategories::withCount('foodPlaces')
            ->orderBy('created_at', 'desc')
            ->get();

        $foodPlaces = FoodPlace::with(['category', 'user', 'reviews'])
            ->withCount('reviews')
            ->orderBy('created_at', 'desc')
            ->get();

        $reviews = Review::with(['foodPlace', 'user'])
            ->orderBy('created_at', 'desc')
            ->get();

        $users = User::orderBy('created_at', 'desc')->get();

        // Calculate additional stats
        $stats = [
            'total_categories' => $categories->count(),
            'total_food_places' => $foodPlaces->count(),
            'total_users' => $users->count(),
            'total_reviews' => $reviews->count(),
            'pending_food_places' => $foodPlaces->where('status', 'pending')->count(),
            'active_food_places' => $foodPlaces->where('status', 'active')->count(),
            'rejected_food_places' => $foodPlaces->where('status', 'rejected')->count(),
            'total_pengusaha' => $users->where('role', 'pengusaha')->count(),
            'total_pelanggan' => $users->where('role', 'pelanggan')->count(),
            'average_rating' => $reviews->avg('rating') ?? 0,
        ];

        return view("admin.dashboard.index", compact(
            'categories',
            'foodPlaces',
            'users',
            'reviews',
            'stats'
        ));
    }
}
