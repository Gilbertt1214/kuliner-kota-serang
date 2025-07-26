<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        dd($user);
        // Check if user is suspended before allowing login
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
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        $credentials = $this->credentials($request);

        // First check if user exists and is suspended before attempting authentication
        $user = \App\Models\User::where($this->username(), $credentials[$this->username()])->first();

        if ($user && $user->isSuspended()) {
            $message = 'Akun Anda telah di-suspend';
            if ($user->suspended_until) {
                $message .= ' hingga ' . $user->suspended_until->format('d M Y H:i');
            } else {
                $message .= ' secara permanen';
            }

            if ($user->suspension_reason) {
                $message .= '. Alasan: ' . $user->suspension_reason;
            }

            throw ValidationException::withMessages([
                $this->username() => [$message],
            ]);
        }

        return $this->guard()->attempt(
            $credentials,
            $request->filled('remember')
        );
    }
}
