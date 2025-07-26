<?php

use App\Http\Controllers\DashboardPengusaha;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FoodPlaceController;
use App\Http\Controllers\AdminFoodPlaceController;
use App\Http\Controllers\PengusahaController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardAdmin;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminReportController;
use App\Http\Controllers\ReviewReportController;
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

    // ===========================
    // AUTHENTICATED PENGUSAHA ROUTES
    // ===========================
    Route::middleware(['auth'])->prefix('pengusaha')->name('pengusaha.')->group(function () {

        // Dashboard with inline role check
        Route::get('/dashboard', [DashboardPengusaha::class, 'index'])->name('dashboard');

        // Food Places Management for Pengusaha - with inline role checks
        Route::prefix('food-places')->name('food-places.')->group(function () {

            Route::get('/', function () {
                if (Auth::user()->role !== 'pengusaha') {
                    abort(403, 'Unauthorized');
                }
                return app(PengusahaController::class)->index();
            })->name('index');

            Route::get('/create', function () {
                if (Auth::user()->role !== 'pengusaha') {
                    abort(403, 'Unauthorized');
                }
                return app(PengusahaController::class)->create();
            })->name('create');

            Route::post('/', function () {
                if (Auth::user()->role !== 'pengusaha') {
                    abort(403, 'Unauthorized');
                }
                return app(PengusahaController::class)->store(request());
            })->name('store');

            Route::get('/{id}', function ($id) {
                if (Auth::user()->role !== 'pengusaha') {
                    abort(403, 'Unauthorized');
                }
                return app(PengusahaController::class)->show($id);
            })->name('show');

            Route::get('/{id}/edit', function ($id) {
                if (Auth::user()->role !== 'pengusaha') {
                    abort(403, 'Unauthorized');
                }
                return app(PengusahaController::class)->edit($id);
            })->name('edit');

            Route::put('/{id}', function ($id) {
                if (Auth::user()->role !== 'pengusaha') {
                    abort(403, 'Unauthorized');
                }
                return app(PengusahaController::class)->update(request(), $id);
            })->name('update');

            Route::delete('/{id}', function ($id) {
                if (Auth::user()->role !== 'pengusaha') {
                    abort(403, 'Unauthorized');
                }
                return app(PengusahaController::class)->destroy($id);
            })->name('destroy');
        });
    });

    // Reviews (Auth required)
    Route::post('/food-place/{id}/review', [ReviewController::class, 'store'])
        ->name('review.store');
    
    // Review Reports (Auth required)
    Route::post('/review/{reviewId}/report', [ReviewReportController::class, 'store'])
        ->name('review.report.store');
    Route::get('/pengusaha/reports', [ReviewReportController::class, 'index'])
        ->name('pengusaha.reports.index');

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
        Route::patch('/{id}/approve', [AdminFoodPlaceController::class, 'approve'])->name('approve');
        Route::patch('/{id}/reject', [AdminFoodPlaceController::class, 'reject'])->name('reject');
        Route::patch('/{id}/status', [AdminFoodPlaceController::class, 'updateStatus'])->name('updateStatus');
    });

    // Categories Management
    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('/', [AdminCategoryController::class, 'index'])->name('index');
        Route::get('/create', [AdminCategoryController::class, 'create'])->name('create');
        Route::post('/', [AdminCategoryController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [AdminCategoryController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AdminCategoryController::class, 'update'])->name('update');
        Route::delete('/{id}', [AdminCategoryController::class, 'destroy'])->name('destroy');
    });

    // Users Management
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [AdminUserController::class, 'index'])->name('index');
        Route::post('/', [AdminUserController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [AdminUserController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AdminUserController::class, 'update'])->name('update');
        Route::delete('/{id}', [AdminUserController::class, 'destroy'])->name('destroy');
    });

    // Reports Management
    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('/', [AdminReportController::class, 'index'])->name('index');
        Route::get('/{id}', [AdminReportController::class, 'show'])->name('show');
        Route::post('/{id}/approve', [AdminReportController::class, 'approve'])->name('approve');
        Route::post('/{id}/reject', [AdminReportController::class, 'reject'])->name('reject');
    });
});

// ===========================
// AUTHENTICATION ROUTES
// ===========================
require __DIR__ . '/auth.php';

// Debug routes (remove in production)
require __DIR__ . '/debug.php';
