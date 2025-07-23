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
use App\Http\Controllers\FoodSearchController;
use App\Http\Middleware\IsAdmin;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ===========================
// PUBLIC ROUTES
// ===========================

// Home page dengan categories
Route::get('/', [HomeController::class, 'index'])->name('home');
// Food Places - Public access
Route::get('/food-places', [FoodPlaceController::class, 'index'])->middleware('auth')->name('food-places.index');
Route::get('/food-place/{id}', [FoodPlaceController::class, 'show'])->name('food-place.show');

// Search functionality
Route::get('/search', [FoodSearchController::class, 'index'])->name('food.search');


// Review Form (Public view)
Route::get('/form-ulasan', function () {
    return view('components.form-ulasan');
})->name('ulasan');

// Reviews
Route::get('/food-place/{id}/reviews', [ReviewController::class, 'index'])->name('review.index');

// ===========================
// GOOGLE OAUTH ROUTES
// ===========================
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

// ===========================
// AUTHENTICATED USER ROUTES
// ===========================
Route::middleware('auth')->group(function () {

    // Profile Management
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    // User Dashboard
    Route::get('/dashboard-pengusaha', [DashboardController::class, 'index'])
        ->name('dashboard.pengusaha');

    // Reviews (Auth required)
    Route::post('/food-place/{id}/review', [ReviewController::class, 'store'])
        ->name('review.store');

    // Verified User Routes
    Route::middleware('verified')->group(function () {
        // Additional verified-only routes can be added here
    });
});

// ===========================
// ADMIN ROUTES
// ===========================
Route::middleware([IsAdmin::class])->prefix('admin')->name('admin.')->group(function () {

    // Admin Dashboard
    Route::get('/dashboard', [DashboardAdmin::class, 'index'])->name('dashboard');

    // Food Places Management
    Route::prefix('food-places')->name('food-places.')->group(function () {
        Route::get('/', [AdminFoodPlaceController::class, 'index'])->name('index');
        Route::get('/create', [AdminFoodPlaceController::class, 'create'])->name('create');
        Route::post('/', [AdminFoodPlaceController::class, 'store'])->name('store');
        Route::get('/{id}', [AdminFoodPlaceController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [AdminFoodPlaceController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AdminFoodPlaceController::class, 'update'])->name('update');
        Route::delete('/{id}', [AdminFoodPlaceController::class, 'destroy'])->name('destroy');
        Route::post('/save', [AdminFoodPlaceController::class, 'save'])->name('save');
    });

    // Categories Management
    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('/', [AdminCategoryController::class, 'index'])->name('index');
        Route::get('/create', [AdminCategoryController::class, 'create'])->name('create');
        Route::post('/', [AdminCategoryController::class, 'store'])->name('store');
        Route::get('/{category}/edit', [AdminCategoryController::class, 'edit'])->name('edit');
        Route::put('/{category}', [AdminCategoryController::class, 'update'])->name('update');
        Route::delete('/{category}', [AdminCategoryController::class, 'destroy'])->name('destroy');
    });

    // Users Management
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [AdminUserController::class, 'index'])->name('index');
        // Add more user management routes as needed
    });
});

// ===========================
// AUTHENTICATION ROUTES
// ===========================
require __DIR__ . '/auth.php';
