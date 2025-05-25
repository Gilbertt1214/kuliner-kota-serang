<?php

namespace App\Http\Controllers;

use App\Models\FoodPlace;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FoodPlaceController extends Controller
{
    /**
     * Show the food place registration form.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Store a newly created food place in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validasi input form
        $validated = $request->validate([
            'title'            => 'required|string|max:255',
            'description'      => 'required|string',
            'category'         => 'required|string|max:100',
            'min_price'        => 'required|numeric|min:0',
            'max_price'        => 'required|numeric|min:0|gte:min_price',
            'location'         => 'required|string|max:255',
            'source_location'  => 'nullable|url|max:255',
            'image'            => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'max_price.gte' => 'Harga maksimum harus lebih besar atau sama dengan harga minimum.',
        ]);

        // Handle upload gambar
        if ($request->hasFile('image')) {
            $image      = $request->file('image');
            $imageName  = Str::slug($validated['title']) . '-' . time() . '.' . $image->getClientOriginalExtension();
            $imagePath  = 'images/food-places/' . $imageName;
            $image->move(public_path('images/food-places'), $imageName);

            $validated['image'] = $imagePath;
        }

        // Simpan data tempat makan ke database
        FoodPlace::create([
            'title'           => $validated['title'],
            'description'     => $validated['description'],
            'category'        => $validated['category'],
            'min_price'       => $validated['min_price'],
            'max_price'       => $validated['max_price'],
            'location'        => $validated['location'],
            'source_location' => $validated['source_location'] ?? null,
            'image'           => $validated['image'],
            'status'          => 'pending', // default status menunggu persetujuan admin
        ]);

        return redirect()
            ->route('food-places.index')
            ->with('success', 'Tempat makan berhasil didaftarkan dan menunggu persetujuan admin!');
    }
}
