<?php
namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\FoodPlace;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Store a new review for a food place.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $foodPlaceId
     * @return \Illuminate\Http\Response
     */
    public function index($foodPlaceId)
    {
        $foodPlace = FoodPlace::findOrFail($foodPlaceId);
        $reviews = $foodPlace->reviews()->with('user')->get();
        return view('components.form-ulasan', compact('foodPlace', 'reviews'));
    }
    public function store(Request $request, $foodPlaceId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        Review::create([
            'user_id' => auth()->id(),
            'food_place_id' => $foodPlaceId,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

         return redirect()-> route('food-place.show',$foodPlaceId) ->with('success', 'Ulasan berhasil dikirim!');
    }
}
