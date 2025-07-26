<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckSuspension
{
  public function handle(Request $request, Closure $next)
  {
    if (Auth::check()) {
      $user = Auth::user();

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

        return redirect('/login')->with('error', $message);
      }
    }

    return $next($request);
  }
}
