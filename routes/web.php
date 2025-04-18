<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FoodPlaceController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('home');
})->name('home');

// Google OAuth Routes
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index']);

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Food Place Routes
Route::get('/food-places', [FoodPlaceController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('food-places.index');

Route::get('/food-place/{id}', [FoodPlaceController::class, 'show'])
    ->middleware(['auth', 'verified'])->name('food-place.show');

// Auth scaffolding (Laravel Breeze/Fortify/etc.)
require __DIR__.'/auth.php';
