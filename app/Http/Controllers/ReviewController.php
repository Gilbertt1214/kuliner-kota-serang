<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\FoodPlace;
use Illuminate\Http\Request;
use App\Models\FoodCategories;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
        // Debug: log incoming request data
        Log::info('=== REVIEW SUBMISSION START ===');
        Log::info('User ID:', ['user_id' => Auth::id()]);
        Log::info('Food Place ID:', ['food_place_id' => $foodPlaceId]);
        Log::info('Request Data:', $request->all());
        Log::info('Request Headers:', $request->headers->all());

        // Validate user authentication
        if (!Auth::check()) {
            Log::error('User not authenticated');
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        // Validate food place exists
        $foodPlace = FoodPlace::find($foodPlaceId);
        if (!$foodPlace) {
            Log::error('Food place not found:', ['id' => $foodPlaceId]);
            return redirect()->route('food-places.index')->with('error', 'Tempat makan tidak ditemukan.');
        }

        // Validasi input dengan pesan error yang lebih jelas
        try {
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
                'is_anonymous' => 'nullable|in:on,1,true', // Accept checkbox values
            ], [
                'rating.required' => 'Rating wajib diisi',
                'comment.required' => 'Komentar wajib diisi',
                'comment.min' => 'Komentar minimal 10 karakter',
                'comment.max' => 'Komentar maksimal 1000 karakter',
                'review_photos.*.image' => 'File harus berupa gambar',
                'review_photos.*.max' => 'Ukuran gambar maksimal 2MB',
                'is_anonymous.in' => 'Format opsi anonim tidak valid',
            ]);

            Log::info('Validation passed:', $validated);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation failed:', $e->errors());
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput()
                ->with('error', 'Data tidak valid. Silakan periksa kembali.');
        }

        // Handle photo uploads
        $photos = [];
        if ($request->hasFile('review_photos')) {
            Log::info('Processing uploaded photos:', ['count' => count($request->file('review_photos'))]);
            try {
                foreach ($request->file('review_photos') as $photo) {
                    $path = $photo->store('review-photos', 'public');
                    $photos[] = $path;
                    Log::info('Photo uploaded:', ['path' => $path]);
                }
            } catch (\Exception $e) {
                Log::error('Photo upload failed:', ['error' => $e->getMessage()]);
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Gagal mengupload foto. Silakan coba lagi.');
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
            'tags' => isset($validated['tags']) && !empty($validated['tags']) ? $validated['tags'] : null,
            'photos' => !empty($photos) ? $photos : null,
            'is_anonymous' => $request->has('is_anonymous') && in_array($request->input('is_anonymous'), ['on', '1', 'true', true]),
        ];

        // Debug: log data to be inserted
        Log::info('Data to be inserted:', $data);

        // Create review
        try {
            $review = Review::create($data);
            Log::info('Review created successfully:', [
                'id' => $review->id,
                'user_id' => $review->user_id,
                'food_place_id' => $review->food_place_id
            ]);

            Log::info('=== REVIEW SUBMISSION SUCCESS ===');

            return redirect()->route('food-place.show', $foodPlaceId)
                ->with('success', 'Ulasan berhasil dikirim! Terima kasih atas kontribusi Anda.');
        } catch (\Exception $e) {
            Log::error('Database error when creating review:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'data' => $data
            ]);

            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan ulasan. Error: ' . $e->getMessage());
        }
    }
}
