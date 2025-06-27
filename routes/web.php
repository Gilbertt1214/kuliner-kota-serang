<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FoodPlaceController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;

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


// ---------------- Dashboard ----------------
// Dashboard untuk admin (dengan middleware auth dan is_admin)
Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin-dashboard');
});

// Dashboard untuk pengusaha (user biasa)
Route::get('/dashboard-pengusaha', [DashboardController::class, 'index'])->name('dashboardpengusaha');


// ---------------- Profile ----------------
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//----------------- Review ----------------
Route::post('/food-place/{id}/review', [ReviewController::class, 'store'])->middleware('auth')->name('review.store');



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
