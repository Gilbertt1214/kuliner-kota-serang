<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FoodPlaceController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\ReviewController;
use App\Http\Middleware\CheckRole;
use App\Http\Middleware\IsAdmin;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman utama
Route::get('/', function () {
    return view('layouts.home');
})->name('home');


// ---------------- Google OAuth ----------------
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);


// Dashboard untuk pengusaha (user biasa)
Route::get('/dashboard-pengusaha', [DashboardController::class, 'index'])->name('dashboardpengusaha');

route::get('/form-ulasan', function () {
    return view('components.form-ulasan');
})->name('ulasan');
// ---------------- Profile ----------------
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


//----------------- Review ----------------
Route::post('/food-place/{id}/review', [ReviewController::class, 'store'])->middleware('auth')->name('review.store');

// ulasan untuk food place
Route::get('/food-place/{id}/reviews', [ReviewController::class, 'index'])->name('review.index');


// ---------------- Admin Routes ----------------
Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/food-places', [FoodPlaceController::class, 'adminIndex'])->name('admin.food-places.index');
    Route::get('/admin/food-place/{id}', [FoodPlaceController::class, 'adminShow'])->name('admin.food-place.show');
    Route::post('/admin/food-place/{id}/approve', [FoodPlaceController::class, 'approve'])->name('admin.food-place.approve');
    Route::post('/admin/food-place/{id}/reject', [FoodPlaceController::class, 'reject'])->name('admin.food-place.reject');
});



// ---------------- Form Pendaftaran Usaha ----------------
Route::get('/form-pendaftaran-usaha', [BusinessController::class, 'create'])->name('business.create');
Route::post('/form-pendaftaran-usaha', [BusinessController::class, 'store'])->name('business.store');


// ---------------- Food Place ----------------
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/food-places', [FoodPlaceController::class, 'index'])->name('food-places.index');
    Route::get('/food-place/{id}', [FoodPlaceController::class, 'show'])->name('food-place.show');
});


// ---------------- Auth Routes ----------------
require __DIR__ . '/auth.php';
