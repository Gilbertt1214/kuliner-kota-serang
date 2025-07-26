<?php

namespace App\Listeners;

use App\Events\UserSuspended;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class InvalidateUserSessions
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserSuspended $event): void
    {
        $user = $event->user;
        
        Log::info('UserSuspended event triggered for user: ' . $user->name);
        
        try {
            // Delete all sessions for this user
            DB::table('sessions')
                ->whereJsonContains('payload->login_web_' . config('auth.guards.web.provider') . '_' . $user->id, $user->id)
                ->delete();
                
            Log::info('Sessions invalidated for suspended user: ' . $user->name);
        } catch (\Exception $e) {
            Log::error('Failed to invalidate sessions for user: ' . $user->name . '. Error: ' . $e->getMessage());
        }
    }
}
