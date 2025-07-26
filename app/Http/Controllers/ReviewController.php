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
     * Show the review form for a food place.
     *
     * @param  int  $foodPlaceId
     * @return \Illuminate\Contracts\View\View
     */
    public function index($foodPlaceId)
    {
        $foodPlace = FoodPlace::findOrFail($foodPlaceId);
        $reviews = $foodPlace->reviews()->with('user')->get();
        $categories = FoodCategories::with('foodPlaces')->withCount('foodPlaces')->get();

        // Check if current user has already reviewed this place
        $userReview = null;
        if (Auth::check()) {
            // Check if user is suspended
            $user = Auth::user();
            if ($user->isSuspended()) {
                Auth::logout();
                return redirect()->route('login')->with('error', 'Akun Anda telah di-suspend dan tidak dapat menulis review.');
            }

            $userReview = $foodPlace->reviews()
                ->where('user_id', Auth::id())
                ->first();
        }

        return view('components.form-ulasan', compact('foodPlace', 'reviews', 'categories', 'userReview'));
    }
    public function store(Request $request, $foodPlaceId)
    {
        // Validate user authentication
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        // Check if user is suspended
        $user = Auth::user();
        if ($user->isSuspended()) {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Akun Anda telah di-suspend dan tidak dapat menulis review.');
        }

        // Validate food place exists
        $foodPlace = FoodPlace::find($foodPlaceId);
        if (!$foodPlace) {
            return redirect()->route('food-places.index')->with('error', 'Tempat makan tidak ditemukan.');
        }

        // Check if user has already reviewed this food place
        $existingReview = Review::where('user_id', Auth::id())
            ->where('food_place_id', $foodPlaceId)
            ->first();

        if ($existingReview) {
            return redirect()->route('food-places.show', $foodPlaceId)
                ->with('error', 'Anda sudah memberikan ulasan untuk tempat ini. Setiap pengguna hanya dapat memberikan satu ulasan per tempat.');
        }

        // Validate input
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:10|max:1000',
            'taste_rating' => 'nullable|integer|min:1|max:5',
            'price_rating' => 'nullable|integer|min:1|max:5',
            'service_rating' => 'nullable|integer|min:1|max:5',
            'ambiance_rating' => 'nullable|integer|min:1|max:5',
            'tags' => 'nullable|array|max:8',
            'tags.*' => 'string|max:50',
            'review_photos' => 'nullable|array|max:3',
            'review_photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_anonymous' => 'nullable|in:on,1,true',
        ], [
            'rating.required' => 'Rating wajib diisi',
            'comment.required' => 'Komentar wajib diisi',
            'comment.min' => 'Komentar minimal 10 karakter',
            'comment.max' => 'Komentar maksimal 1000 karakter',
            'review_photos.*.image' => 'File harus berupa gambar',
            'review_photos.*.max' => 'Ukuran gambar maksimal 2MB',
            'is_anonymous.in' => 'Format opsi anonim tidak valid',
        ]);

        // Handle photo uploads
        $photos = [];
        if ($request->hasFile('review_photos')) {
            try {
                foreach ($request->file('review_photos') as $photo) {
                    $path = $photo->store('review-photos', 'public');
                    $photos[] = $path;
                }
            } catch (\Exception $e) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Gagal mengupload foto. Silakan coba lagi.');
            }
        }

        // Prepare data for insert
        $data = [
            'user_id' => Auth::id(),
            'food_place_id' => (int) $foodPlaceId,
            'rating' => (int) $validated['rating'],
            'comment' => $validated['comment'],
            'taste_rating' => isset($validated['taste_rating']) ? (int) $validated['taste_rating'] : null,
            'price_rating' => isset($validated['price_rating']) ? (int) $validated['price_rating'] : null,
            'service_rating' => isset($validated['service_rating']) ? (int) $validated['service_rating'] : null,
            'ambiance_rating' => isset($validated['ambiance_rating']) ? (int) $validated['ambiance_rating'] : null,
            'tags' => isset($validated['tags']) && !empty($validated['tags']) ? $validated['tags'] : null,
            'photos' => !empty($photos) ? $photos : null,
            'is_anonymous' => $request->has('is_anonymous') && in_array($request->input('is_anonymous'), ['on', '1', 'true', true]),
        ];

        // Create review
        try {
            $review = Review::create($data);

            return redirect()->route('food-place.show', $foodPlaceId)
                ->with('success', 'Ulasan berhasil dikirim! Terima kasih atas kontribusi Anda.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan ulasan. Silakan coba lagi.');
        }
    }
}
