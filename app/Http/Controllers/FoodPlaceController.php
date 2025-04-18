<?php

namespace App\Http\Controllers;
use App\Models\FoodPlace;
use Illuminate\Http\Request;

class FoodPlaceController extends Controller
{
    //
    public function index()
    {
        // Logic to fetch and display food places
        $foodPlaces = FoodPlace::all();
        return view('food-places', compact('foodPlaces'));
    }

    public function show($id)
    {
        // Logic to fetch and display a single food place
        $foodPlace = FoodPlace::findOrFail($id);
        return view('food-place-detail', compact('foodPlace'));
    }
}
