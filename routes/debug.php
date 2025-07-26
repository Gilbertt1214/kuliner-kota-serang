<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Review;
use App\Models\ReviewReport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

Route::get('/debug-fix-reviews', function () {
  \Artisan::call('review:fix-hidden');

  $hiddenCount = Review::where('is_hidden', true)->count();
  $approvedReports = ReviewReport::where('status', 'approved')->count();

  return response()->json([
    'message' => 'Reviews fixed',
    'hidden_reviews_count' => $hiddenCount,
    'approved_reports_count' => $approvedReports
  ]);
});

Route::get('/debug-reviews-status', function () {
  $reviews = Review::with(['user', 'reportReviews' => function ($q) {
    $q->where('status', 'approved');
  }])->get()->map(function ($review) {
    return [
      'id' => $review->id,
      'user' => $review->user->name,
      'rating' => $review->rating,
      'is_hidden' => $review->is_hidden,
      'has_approved_report' => $review->reportReviews->count() > 0,
      'comment' => substr($review->comment, 0, 50) . '...'
    ];
  });

  return response()->json($reviews);
});

// Force logout all suspended users
Route::get('/debug-force-logout-suspended', function () {
  $suspendedUsers = User::where('is_suspended', true)->get();
  $loggedOutCount = 0;

  foreach ($suspendedUsers as $user) {
    // Delete all sessions for suspended users
    try {
      DB::table('sessions')
        ->whereJsonContains('payload', ['login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d' => $user->id])
        ->delete();
      $loggedOutCount++;
    } catch (\Exception $e) {
      // Continue with next user
    }
  }

  return response()->json([
    'message' => 'Forced logout for all suspended users',
    'suspended_users_count' => $suspendedUsers->count(),
    'sessions_cleared' => $loggedOutCount,
    'suspended_users' => $suspendedUsers->map(function ($user) {
      return [
        'name' => $user->name,
        'email' => $user->email,
        'suspended_until' => $user->suspended_until,
        'suspension_reason' => $user->suspension_reason
      ];
    })
  ]);
});

// Check current user suspension status
Route::get('/debug-check-session', function () {
  if (!Auth::check()) {
    return response()->json(['message' => 'No user logged in']);
  }

  $user = Auth::user();
  $user->refresh(); // Get latest data from database

  return response()->json([
    'logged_in_user' => $user->name,
    'email' => $user->email,
    'is_suspended' => $user->is_suspended,
    'suspended_until' => $user->suspended_until,
    'suspension_reason' => $user->suspension_reason,
    'isSuspended_method' => $user->isSuspended(),
    'session_id' => session()->getId()
  ]);
});

// Test login attempt for suspended user
Route::post('/debug-test-login', function () {
  $email = request('email');
  $password = request('password', 'password'); // default password

  $user = User::where('email', $email)->first();
  if (!$user) {
    return response()->json(['error' => 'User not found']);
  }

  // Check suspension before attempting login
  if ($user->isSuspended()) {
    return response()->json([
      'error' => 'User is suspended',
      'user' => $user->name,
      'suspended_until' => $user->suspended_until,
      'suspension_reason' => $user->suspension_reason
    ]);
  }

  // Attempt login
  if (Auth::attempt(['email' => $email, 'password' => $password])) {
    return response()->json([
      'success' => 'Login successful',
      'user' => Auth::user()->name
    ]);
  } else {
    return response()->json(['error' => 'Invalid credentials']);
  }
});
