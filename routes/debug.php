<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;

Route::get('/debug-user/{name}', function ($name) {
    $user = User::where('name', $name)->first();
    
    if (!$user) {
        return response()->json(['error' => 'User not found']);
    }
    
    return response()->json([
        'name' => $user->name,
        'email' => $user->email,
        'role' => $user->role,
        'is_suspended' => $user->is_suspended,
        'suspended_until' => $user->suspended_until,
        'suspension_reason' => $user->suspension_reason,
        'warning_count' => $user->warning_count,
        'isSuspended_method' => $user->isSuspended()
    ]);
});

Route::get('/debug-ban-user/{name}', function ($name) {
    $user = User::where('name', $name)->first();
    
    if (!$user) {
        return response()->json(['error' => 'User not found']);
    }
    
    // Force ban user
    $user->update([
        'is_suspended' => true,
        'suspended_until' => null, // permanent ban
        'suspension_reason' => 'Manual ban via debug - Pelanggaran berat'
    ]);
    
    return response()->json([
        'message' => 'User banned successfully',
        'user' => [
            'name' => $user->name,
            'is_suspended' => $user->is_suspended,
            'suspended_until' => $user->suspended_until,
            'suspension_reason' => $user->suspension_reason,
            'isSuspended_method' => $user->isSuspended()
        ]
    ]);
});

Route::get('/debug-clear-cache', function () {
    \Artisan::call('cache:clear');
    \Artisan::call('config:clear');
    \Artisan::call('view:clear');
    
    return response()->json(['message' => 'Cache cleared successfully']);
});
