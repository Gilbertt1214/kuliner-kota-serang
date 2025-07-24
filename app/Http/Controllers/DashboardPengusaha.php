<?php

namespace App\Http\Controllers;

use App\Models\FoodCategories;
use App\Models\FoodPlace;
use Illuminate\Support\Facades\Auth;

class DashboardPengusaha extends Controller
{
    public function index()
    {
        if (Auth::user()->role !== 'pengusaha') {
            abort(403, 'Unauthorized');
        }

        $user = Auth::user();
        $foodPlaces = FoodPlace::where('user_id', $user->id)
            ->with(['category', 'images', 'reviews'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Calculate comprehensive statistics
        $stats = [
            'total' => $foodPlaces->count(),
            'pending' => $foodPlaces->where('status', 'pending')->count(),
            'active' => $foodPlaces->where('status', 'active')->count(),
            'rejected' => $foodPlaces->where('status', 'rejected')->count(),
            'total_reviews' => $foodPlaces->sum(function ($place) {
                return $place->reviews->count();
            }),
            'average_rating' => $this->calculateAverageRating($foodPlaces),
        ];

        // Recent food places for display
        $recentFoodPlaces = $foodPlaces->take(6);

        $categories = FoodCategories::with('foodPlaces')->withCount('foodPlaces')->get();

        return view('pengusaha.dashboard', compact('recentFoodPlaces', 'stats', 'categories'));
    }

    private function calculateAverageRating($foodPlaces)
    {
        $totalRating = 0;
        $totalReviews = 0;

        foreach ($foodPlaces as $place) {
            foreach ($place->reviews as $review) {
                $totalRating += $review->rating;
                $totalReviews++;
            }
        }

        return $totalReviews > 0 ? round($totalRating / $totalReviews, 1) : 0;
    }
}
