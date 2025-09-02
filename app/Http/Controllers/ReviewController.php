<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\FoodPlace;
use Illuminate\Http\Request;
use App\Models\FoodCategories;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
            return redirect()->route('food-place.show', $foodPlaceId)
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

    /**
     * Show the form for editing the specified review.
     *
     * @param  int  $foodPlaceId
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($foodPlaceId, Review $review)
    {
        // Validate user authentication
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        // Check if user is suspended
        $user = Auth::user();
        if ($user->isSuspended()) {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Akun Anda telah di-suspend dan tidak dapat mengedit review.');
        }

        // Validate food place exists
        $foodPlace = FoodPlace::findOrFail($foodPlaceId);

        // Check if user owns this review or is admin
        if ($review->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            return redirect()->route('food-place.show', $foodPlaceId)
                ->with('error', 'Anda tidak memiliki izin untuk mengedit ulasan ini.');
        }

        // Check if review belongs to this food place
        if ($review->food_place_id != $foodPlaceId) {
            return redirect()->route('food-place.show', $foodPlaceId)
                ->with('error', 'Ulasan tidak ditemukan untuk tempat ini.');
        }

        $categories = FoodCategories::with('foodPlaces')->withCount('foodPlaces')->get();

      
    }

    /**
     * Update the specified review in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $foodPlaceId
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $foodPlaceId, Review $review)
    {
        // Validate user authentication
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        // Check if user is suspended
        $user = Auth::user();
        if ($user->isSuspended()) {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Akun Anda telah di-suspend dan tidak dapat mengedit review.');
        }

        // Validate food place exists
        $foodPlace = FoodPlace::findOrFail($foodPlaceId);

        // Check if user owns this review or is admin
        if ($review->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            return redirect()->route('food-place.show', $foodPlaceId)
                ->with('error', 'Anda tidak memiliki izin untuk mengedit ulasan ini.');
        }

        // Check if review belongs to this food place
        if ($review->food_place_id != $foodPlaceId) {
            return redirect()->route('food-place.show', $foodPlaceId)
                ->with('error', 'Ulasan tidak ditemukan untuk tempat ini.');
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
            'remove_photos' => 'nullable|array',
            'remove_photos.*' => 'string',
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

        // Handle existing photos
        $currentPhotos = $review->photos ?? [];
        $removePhotos = $request->input('remove_photos', []);

        // Remove selected photos from storage and array
        foreach ($removePhotos as $photoToRemove) {
            if (in_array($photoToRemove, $currentPhotos)) {
                try {
                    Storage::disk('public')->delete($photoToRemove);
                    $currentPhotos = array_diff($currentPhotos, [$photoToRemove]);
                } catch (\Exception $e) {
                    // Log error but continue processing
                }
            }
        }

        // Handle new photo uploads
        if ($request->hasFile('review_photos')) {
            // Check if adding new photos would exceed the limit
            $totalPhotos = count($currentPhotos) + count($request->file('review_photos'));
            if ($totalPhotos > 3) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Total foto tidak boleh lebih dari 3. Hapus beberapa foto lama sebelum menambah foto baru.');
            }

            try {
                foreach ($request->file('review_photos') as $photo) {
                    $path = $photo->store('review-photos', 'public');
                    $currentPhotos[] = $path;
                }
            } catch (\Exception $e) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Gagal mengupload foto. Silakan coba lagi.');
            }
        }

        // Prepare data for update
        $updateData = [
            'rating' => (int) $validated['rating'],
            'comment' => $validated['comment'],
            'taste_rating' => isset($validated['taste_rating']) ? (int) $validated['taste_rating'] : null,
            'price_rating' => isset($validated['price_rating']) ? (int) $validated['price_rating'] : null,
            'service_rating' => isset($validated['service_rating']) ? (int) $validated['service_rating'] : null,
            'ambiance_rating' => isset($validated['ambiance_rating']) ? (int) $validated['ambiance_rating'] : null,
            'tags' => isset($validated['tags']) && !empty($validated['tags']) ? $validated['tags'] : null,
            'photos' => !empty($currentPhotos) ? array_values($currentPhotos) : null,
            'is_anonymous' => $request->has('is_anonymous') && in_array($request->input('is_anonymous'), ['on', '1', 'true', true]),
        ];

        // Update review
        try {
            $review->update($updateData);

            return redirect()->route('food-place.show', $foodPlaceId)
                ->with('success', 'Ulasan berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal memperbarui ulasan. Silakan coba lagi.');
        }
    }

    /**
     * Remove the specified review from storage.
     *
     * @param  int  $foodPlaceId
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($foodPlaceId, Review $review)
    {
        // Validate user authentication
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        // Check if user is suspended
        $user = Auth::user();
        if ($user->isSuspended()) {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Akun Anda telah di-suspend dan tidak dapat menghapus review.');
        }

        // Validate food place exists
        $foodPlace = FoodPlace::findOrFail($foodPlaceId);

        // Check if user owns this review or is admin
        if ($review->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            return redirect()->route('food-place.show', $foodPlaceId)
                ->with('error', 'Anda tidak memiliki izin untuk menghapus ulasan ini.');
        }

        // Check if review belongs to this food place
        if ($review->food_place_id != $foodPlaceId) {
            return redirect()->route('food-place.show', $foodPlaceId)
                ->with('error', 'Ulasan tidak ditemukan untuk tempat ini.');
        }

        try {
            // Delete photos from storage if they exist
            if ($review->photos) {
                foreach ($review->photos as $photo) {
                    try {
                        Storage::disk('public')->delete($photo);
                    } catch (\Exception $e) {
                        // Log error but continue with deletion
                    }
                }
            }

            // Delete the review from database
            $review->delete();

            // Redirect ke halaman detail food place dengan route yang benar
            return redirect()->route('food-place.show', $foodPlace->id)
                ->with('success', 'Ulasan berhasil dihapus!');

        } catch (\Exception $e) {
            return redirect()->route('food-place.show', $foodPlace->id)
                ->with('error', 'Gagal menghapus ulasan. Silakan coba lagi.');
        }
    }
}
