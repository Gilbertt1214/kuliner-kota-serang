<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            // Cek user berdasarkan email
            $user = User::firstOrCreate([
                'email' => $googleUser->getEmail()
            ], [
                'name' => $googleUser->getName(),
                'password' => bcrypt('google_default') // Password dummy
            ]);

            Auth::login($user);

            // ✅ Redirect ke halaman setelah login
            return redirect()->intended('/');

        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Gagal login: ' . $e->getMessage());
        }
    }
}


