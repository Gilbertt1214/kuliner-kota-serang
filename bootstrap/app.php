<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // $middleware->register('is_admin', \App\Http\Middleware\IsAdmin::class);
        // $middleware->register('auth', \App\Http\Middleware\Authenticate::class);
        // $middleware->register('guest', \App\Http\Middleware\RedirectIfAuthenticated::class);
        // $middleware->register('throttle', \Illuminate\Routing\Middleware\ThrottleRequests::class);
        // $middleware->register('verified', \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class);
        // $middleware->register('signed', \Illuminate\Routing\Middleware\ValidateSignature::class);
        // $middleware->register('password.confirm', \Illuminate\Auth\Middleware\RequirePassword::class);
        // $middleware->register('can', \Illuminate\Auth\Middleware\Authorize::class);
        // $middleware->register('cache.headers', \Illuminate\Http\Middleware\SetCacheHeaders::class);
        // $middleware->register('auth.basic', \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
