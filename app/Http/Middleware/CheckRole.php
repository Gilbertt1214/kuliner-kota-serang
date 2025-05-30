<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
   public function handle($request, Closure $next, ...$roles)
{
    if (!auth()->check()) {
        return redirect('login');
    }

    if (in_array(auth()->user()->role, $roles)) {
        return $next($request);
    }

    return abort(403, 'Unauthorized action.');
}
}
