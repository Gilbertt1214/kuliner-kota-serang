<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = $request->user(); // Simpan reference user sebelum logout

        if ($user->isSuspended()) {
            Auth::logout();

            $message = 'Akun Anda telah di-suspend';
            if ($user->suspended_until) {
                $message .= ' hingga ' . $user->suspended_until->format('d M Y H:i');
            } else {
                $message .= ' secara permanen';
            }

            if ($user->suspension_reason) {
                $message .= '. Alasan: ' . $user->suspension_reason;
            }

            return redirect()->route('login')->withErrors([
                'email' => $message
            ]);
        }

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'pengusaha') {
            return redirect()->route('pengusaha.dashboard');
        } else {
            return redirect('/food-places');
        }

        // if (Auth::user()->role === 'admin') {
        //     return redirect()->route('admin.food-places.index');
        // } elseif (Auth::user()->role === 'pengusaha') {
        //     return redirect()->route('pengusaha.dashboard');
        // } else {
        //     return redirect('/');
        // }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
