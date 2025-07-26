<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Events\UserSuspended;
use App\Listeners\InvalidateUserSessions;
use Illuminate\Support\Facades\Event;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register event listeners
        Event::listen(
            UserSuspended::class,
            InvalidateUserSessions::class
        );
    }
}
