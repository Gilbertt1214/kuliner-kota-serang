<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\FoodPlace;
use Illuminate\Http\Request;
use App\Models\FoodCategories;
use App\Models\FoodPlaceImage;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class RegisteredUserController extends Controller
{
    public function create()
    {
        $foodCategories = FoodCategories::all();
        return view('auth.register', compact('foodCategories'));
    }

    public function store(Request $request)
    {
        $role = $request->input('role');

        if (!in_array($role, ['user', 'pengusaha'])) {
            return back()->withErrors(['role' => 'Role harus diisi.']);
        }


        // Validasi umum
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', 'in:user,pengusaha'],
        ];

        // Jika pengusaha, tambah validasi food place
        if ($role === 'pengusaha') {
            $rules = array_merge($rules, [
                'title' => ['required', 'string', 'max:255'],
                'description' => ['required', 'string'],
                'pengusaha_category' => ['required', 'exists:food_categories,id'],
                'min_price' => ['required', 'numeric', 'min:0'],
                'max_price' => ['required', 'numeric', 'min:0', 'gte:min_price'],
                'pengusaha_location' => ['required', 'string',],
                'source_location' => ['nullable', 'url',],
                'pengusaha_image' => ['required', 'array', 'min:1', 'max:5'],
                'pengusaha_image.*' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
                'menu_images' => ['required', 'array', 'min:1', 'max:10'],
                'menu_images.*' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            ]);
        }

        $messages = [
            'max_price.gte' => 'Harga maksimum harus lebih besar dari harga minimum.',
            'pengusaha_image.required' => 'Minimal satu gambar usaha harus diunggah.',
            'pengusaha_image.max' => 'Maksimal 5 gambar usaha diperbolehkan.',
            'pengusaha_image.*.image' => 'Setiap file usaha harus berupa gambar.',
            'pengusaha_image.*.mimes' => 'Format gambar usaha hanya jpeg, png, jpg, atau gif.',
            'pengusaha_image.*.max' => 'Ukuran gambar usaha maksimal 2MB.',
            'menu_images.required' => 'Minimal satu foto menu harus diunggah.',
            'menu_images.max' => 'Maksimal 10 foto menu diperbolehkan.',
            'menu_images.*.image' => 'Setiap file menu harus berupa gambar.',
            'menu_images.*.mimes' => 'Format foto menu hanya jpeg, png, jpg, atau gif.',
            'menu_images.*.max' => 'Ukuran foto menu maksimal 2MB.',
        ];


        $validated = $request->validate($rules, $messages);

        // Buat user
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $role,
        ]);

        // Jika pengusaha, buat FoodPlace dan simpan gambar-gambarnya
        if ($role === 'pengusaha') {
            // Upload business images
            $businessImagePaths = [];
            foreach ($request->file('pengusaha_image') as $image) {
                $businessImagePaths[] = $image->store('images/businesses', 'public');
            }

            // Upload menu images
            $menuImagePaths = [];
            foreach ($request->file('menu_images') as $image) {
                $menuImagePaths[] = $image->store('images/menus', 'public');
            }

            // Simpan data FoodPlace
            $foodPlace = FoodPlace::create([
                'title'            => $validated['title'],
                'description'      => $validated['description'],
                'food_category_id' => $validated['pengusaha_category'],
                'min_price'        => $validated['min_price'],
                'max_price'        => $validated['max_price'],
                'location'         => $validated['pengusaha_location'],
                'source_location'  => $validated['source_location'] ?? null,
                'user_id'          => $user->id,
            ]);

            // Simpan semua gambar usaha ke tabel food_place_images dengan type 'business'
            foreach ($businessImagePaths as $path) {
                FoodPlaceImage::create([
                    'food_place_id' => $foodPlace->id,
                    'image_path'    => $path,
                    'type'          => 'business',
                ]);
            }

            // Simpan semua foto menu ke tabel food_place_images dengan type 'menu'
            foreach ($menuImagePaths as $path) {
                FoodPlaceImage::create([
                    'food_place_id' => $foodPlace->id,
                    'image_path'    => $path,
                    'type'          => 'menu',
                ]);
            }
        }

        event(new Registered($user));
        Auth::login($user);

        // Redirect sesuai role
        if ($role === 'pengusaha') {
            return redirect('/pengusaha/dashboard-pengusaha');
        }
        return redirect('/');
    }
}
