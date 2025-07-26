<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CheckSuspension
{
  public function handle(Request $request, Closure $next)
  {
    if (Auth::check()) {
      $user = Auth::user();

      // Log for debugging
      Log::info('CheckSuspension middleware - User: ' . $user->name, [
        'is_suspended' => $user->is_suspended,
        'suspended_until' => $user->suspended_until,
        'suspension_reason' => $user->suspension_reason
      ]);

      // Refresh user data from database to ensure we have latest suspension status
      $user->refresh();

      // Log after refresh
      Log::info('CheckSuspension middleware - After refresh: ' . $user->name, [
        'is_suspended' => $user->is_suspended,
        'suspended_until' => $user->suspended_until,
        'suspension_reason' => $user->suspension_reason,
        'isSuspended_result' => $user->isSuspended()
      ]);

      if ($user->isSuspended()) {
        Log::info('CheckSuspension middleware - User is suspended, logging out: ' . $user->name);
        
        // Force logout
        Auth::logout();

        // Clear all sessions and regenerate token
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        // Clear any remember me cookies
        if ($request->hasCookie(Auth::getRecallerName())) {
          $request->cookies->remove(Auth::getRecallerName());
        }

        $message = 'Akun Anda telah di-suspend';
        if ($user->suspended_until) {
          $message .= ' hingga ' . $user->suspended_until->format('d M Y H:i');
        } else {
          $message .= ' secara permanen';
        }

        if ($user->suspension_reason) {
          $message .= '. Alasan: ' . $user->suspension_reason;
        }

        // If it's an AJAX request, return JSON response
        if ($request->expectsJson()) {
          return response()->json([
            'message' => $message,
            'redirect' => '/login'
          ], 401);
        }

        return redirect('/login')->with('error', $message);
      }
    }

    return $next($request);
  }
}
