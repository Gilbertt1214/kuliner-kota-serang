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
            ->paginate(10);

        $stats = [
            'total' => $foodPlaces->total(),
            'pending' => FoodPlace::where('user_id', $user->id)->where('status', 'pending')->count(),
            'active' => FoodPlace::where('user_id', $user->id)->where('status', 'active')->count(),
            'rejected' => FoodPlace::where('user_id', $user->id)->where('status', 'rejected')->count(),
        ];

        $categories = FoodCategories::with('foodPlaces')->withCount('foodPlaces')->get();

        return view('pengusaha.dashboard', compact('foodPlaces', 'stats', 'categories'));
    }
}
