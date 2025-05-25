<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\FoodPlace;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    public function create()
    {

        return view('auth.register');
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
                'pengusaha_title' => ['required', 'string', 'max:255'],
                'pengusaha_description' => ['required', 'string'],
                'pengusaha_category' => ['required', 'exists:food_categories,name'],
                'min_price' => ['required', 'numeric', 'min:0'],
                'max_price' => ['required', 'numeric', 'min:0', 'gte:min_price'],
                'pengusaha_location' => ['required', 'string', 'max:255'],
                'source_location' => ['nullable', 'url', 'max:255'],
                'pengusaha_image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            ]);
        }


        $validated = $request->validate($rules);
        $category = \App\Models\FoodCategory::where('name', $validated['pengusaha_category'])->firstOrFail();
        dd($category->id);
        // Simpan user
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $role,
        ]);

        // Jika pengusaha, simpan food place
        if ($role === 'pengusaha') {
            $imagePath = $request->file('pengusaha_image')->store('images/businesses', 'public');
            FoodPlace::create([
                'title'            => $validated['pengusaha_title'],
                'description'      => $validated['pengusaha_description'],
                'food_category_id' => $category->id,
                'min_price'        => $validated['min_price'],
                'max_price'        => $validated['max_price'],
                'location'         => $validated['pengusaha_location'],
                'source_location'  => $validated['source_location'] ?? null,
                'image'            => $imagePath,
                'user_id'          => $user->id,
                'status'           => 'pending',

            ]);
        }

        event(new Registered($user));
        Auth::login($user);

        // Redirect sesuai role
        if ($role === 'pengusaha') {
            return redirect('/admin/dashboard');
        }
        return redirect('/');
    }
}
