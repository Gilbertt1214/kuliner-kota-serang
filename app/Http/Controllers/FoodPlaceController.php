<?php

namespace App\Http\Controllers;

use App\Models\FoodPlace;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class FoodPlaceController extends Controller
{

    public function index(Request $request) {
        // Ambil semua categories untuk dropdown filter
        $categories = \App\Models\FoodCategories::withCount('foodPlaces')->get();
        
        // Query dasar untuk food places dengan eager loading
        $query = FoodPlace::with(['category', 'reviews', 'images']);

        // Filter berdasarkan pencarian teks
        if ($request->filled('search')) {
            $searchTerm = $request->get('search');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('description', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('location', 'LIKE', "%{$searchTerm}%");
            });
        }

        // Filter berdasarkan kategori
        if ($request->filled('category') && $request->get('category') != '') {
            $query->where('food_category_id', $request->get('category'));
        }

        // Filter berdasarkan lokasi (jika ada)
        if ($request->filled('location')) {
            $location = $request->get('location');
            $query->where('location', 'LIKE', "%{$location}%");
        }

        // Ambil hasil dengan pagination
        $foodPlaces = $query->paginate(12)->withQueryString();
        
        return view('layouts.food-places', compact('foodPlaces', 'categories'));
    }
    /**
     * Display the specified food place.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $foodPlace = FoodPlace::with(['category', 'reviews.user', 'images'])
            ->findOrFail($id);


        return view('layouts.food-place-detail', ['foodPlace' => $foodPlace]);
    }

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
            'image'            => 'required|array|max:5',
            'image.*'          => 'image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'max_price.gte' => 'Harga maksimum harus lebih besar atau sama dengan harga minimum.',
        ]);

        // Handle upload gambar
        $imagePaths = [];
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $imageName = Str::slug($validated['title']) . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
                $imagePath = 'images/food-places/' . $imageName;
                $image->move(public_path('images/food-places'), $imageName);
                $imagePaths[] = $imagePath;
            }
        }

        // Simpan data tempat makan ke database
        FoodPlace::create([
            'title'           => $validated['title'],
            'description'     => $validated['description'],
            'food_category_id'=> $validated['category'], // Perbaiki field name
            'min_price'       => $validated['min_price'],
            'max_price'       => $validated['max_price'],
            'location'        => $validated['location'],
            'source_location' => $validated['source_location'] ?? null,
            'user_id'         => Auth::id() ?? 1, // Tambahkan user_id
            'status'          => 'pending', // default status menunggu persetujuan admin
        ]);

        return redirect()
            ->route('food-places.index')
            ->with('success', 'Tempat makan berhasil didaftarkan dan menunggu persetujuan admin!');
    }
}
