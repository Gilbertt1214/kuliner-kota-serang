<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FoodPlaceController;
use App\Http\Controllers\AdminFoodPlaceController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardAdmin;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdminUserController;
use App\Http\Middleware\IsAdmin;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/food-places', [FoodPlaceController::class, 'index'])->name('food-places.index');

// Google OAuth
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);


// Review Routes
Route::get('/form-ulasan', function () {
    return view('components.form-ulasan');
})->name('ulasan');
Route::post('/food-place/{id}/review', [ReviewController::class, 'store'])
    ->middleware('auth')
    ->name('review.store');
Route::get('/food-place/{id}/reviews', [ReviewController::class, 'index'])
    ->name('review.index');

// Authenticated User Routes
Route::middleware('auth')->group(function () {
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // User Dashboard
    Route::get('/dashboard-pengusaha', [DashboardController::class, 'index'])
        ->name('dashboard.pengusaha');

    // Food Places
    Route::middleware('verified')->group(function () {
        Route::get('/food-places', [FoodPlaceController::class, 'index'])
            ->name('food-places.index');
        Route::get('/food-place/{id}', [FoodPlaceController::class, 'show'])
            ->name('food-place.show');
    });
});

// Admin Routes
Route::middleware([IsAdmin::class])->prefix('admin')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardAdmin::class, 'index'])
        ->name('admin.dashboard');

    // Food Places Management
    Route::prefix('food-places')->group(function () {
        Route::get('/', [AdminFoodPlaceController::class, 'index'])
            ->name('admin.food-places.index');
        Route::get('/create', [AdminFoodPlaceController::class, 'create'])
            ->name('admin.food-places.create');
        Route::post('/', [AdminFoodPlaceController::class, 'store'])
            ->name('admin.food-places.store');
        Route::get('/{id}', [AdminFoodPlaceController::class, 'show'])
            ->name('admin.food-places.show');
        Route::get('/{id}/edit', [AdminFoodPlaceController::class, 'edit'])
            ->name('admin.food-places.edit');
        Route::put('/{id}', [AdminFoodPlaceController::class, 'update'])
            ->name('admin.food-places.update');
        Route::delete('/{id}', [AdminFoodPlaceController::class, 'destroy'])
            ->name('admin.food-places.destroy');
        Route::post('/save', [AdminFoodPlaceController::class, 'save'])
            ->name('admin.food-places.save');
    });

    // Categories Management
    Route::prefix('admin')->group(function () {
        Route::prefix('categories')->group(function () {
            Route::get('/', [AdminCategoryController::class, 'index'])->name('admin.categories.index');
            Route::get('/create', [AdminCategoryController::class, 'create'])->name('admin.categories.create');
            Route::post('/', [AdminCategoryController::class, 'store'])->name('admin.categories.store');
            Route::get('/{category}/edit', [AdminCategoryController::class, 'edit'])->name('admin.categories.edit');
            Route::put('/{category}', [AdminCategoryController::class, 'update'])->name('admin.categories.update');
            Route::delete('/{category}', [AdminCategoryController::class, 'destroy'])->name('admin.categories.destroy');
        });
    });




    // Users Management
    Route::get('/users', [AdminUserController::class, 'index'])
        ->name('admin.users.index');
});

// Authentication Routes
require __DIR__ . '/auth.php';
