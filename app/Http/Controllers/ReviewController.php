<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\FoodPlace;
use Illuminate\Http\Request;
use App\Models\FoodCategories;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Store a new review for a food place.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $foodPlaceId
     * @return \Illuminate\Contracts\View\View
     */
    public function index($foodPlaceId)
    {
        $foodPlace = FoodPlace::findOrFail($foodPlaceId);
        $reviews = $foodPlace->reviews()->with('user')->get();
        $categories = FoodCategories::with('foodPlaces')->withCount('foodPlaces')->get();

        return view('components.form-ulasan', compact('foodPlace', 'reviews', 'categories'));
    }
    public function store(Request $request, $foodPlaceId)
    {

        // Validasi input
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
            'taste_rating' => 'nullable|integer|min:1|max:5',
            'price_rating' => 'nullable|integer|min:1|max:5',
            'service_rating' => 'nullable|integer|min:1|max:5',
            'ambiance_rating' => 'nullable|integer|min:1|max:5',
            'tags' => 'nullable|array|max:8',
            'review_photos' => 'nullable|array|max:3',
            'review_photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle photo uploads
        $photos = [];
        if ($request->hasFile('review_photos')) {
            foreach ($request->file('review_photos') as $photo) {
                $path = $photo->store('review-photos', 'public');
                $photos[] = $path;
            }
        }

        // Prepare data untuk insert
        $data = [
            'user_id' => Auth::id(),
            'food_place_id' => (int) $foodPlaceId,
            'rating' => (int) $validated['rating'],
            'comment' => $validated['comment'],
            'taste_rating' => isset($validated['taste_rating']) ? (int) $validated['taste_rating'] : null,
            'price_rating' => isset($validated['price_rating']) ? (int) $validated['price_rating'] : null,
            'service_rating' => isset($validated['service_rating']) ? (int) $validated['service_rating'] : null,
            'ambiance_rating' => isset($validated['ambiance_rating']) ? (int) $validated['ambiance_rating'] : null,
            'tags' => $validated['tags'] ?? null,
            'photos' => $photos,
            'is_anonymous' => $request->has('is_anonymous'),
        ];

        // Create review
        $review = Review::create($data);

        return redirect()->route('food-place.show', $foodPlaceId)
            ->with('success', 'Ulasan berhasil dikirim!');
    }
}
