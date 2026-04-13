<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\StatController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\SeoController;
use App\Http\Controllers\Admin\VisitorController;
use App\Http\Controllers\Admin\UserController;

// ─── FRONTEND ───────────────────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/proyek', [HomeController::class, 'projects'])->name('projects');
Route::post('/contact', [HomeController::class, 'contact'])->name('contact.store');

// ─── ADMIN AUTH ──────────────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login',  [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.post');
    Route::post('logout',[AuthController::class, 'logout'])->name('logout');

    // Protected admin routes
    Route::middleware('auth')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Services
        Route::resource('services', ServiceController::class)->except(['show']);

        // Projects
        Route::resource('projects', ProjectController::class)->except(['show']);

        // Testimonials
        Route::resource('testimonials', TestimonialController::class)->except(['show']);

        // Stats
        Route::resource('stats', StatController::class)->except(['show']);

        // Settings
        Route::get('settings',    [SettingController::class, 'index'])->name('settings.index');
        Route::post('settings',   [SettingController::class, 'update'])->name('settings.update');

        // SEO
        Route::get('seo',         [SeoController::class, 'index'])->name('seo.index');
        Route::post('seo',        [SeoController::class, 'update'])->name('seo.update');

        // Visitors
        Route::get('visitors',    [VisitorController::class, 'index'])->name('visitors.index');
        Route::post('visitors/clear', [VisitorController::class, 'clear'])->name('visitors.clear');

        // Messages
        Route::get('messages',        [MessageController::class, 'index'])->name('messages.index');
        Route::get('messages/{message}', [MessageController::class, 'show'])->name('messages.show');
        Route::delete('messages/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');

        // Users (admin only)
        Route::resource('users', UserController::class)->except(['show']);
        Route::post('users/{user}/reset-password', [UserController::class, 'resetPassword'])->name('users.reset-password');

        // Profile & change password (semua role)
        Route::get('profile',          [UserController::class, 'profile'])->name('profile');
        Route::post('profile',         [UserController::class, 'updateProfile'])->name('profile.update');
        Route::post('change-password', [UserController::class, 'changePassword'])->name('change-password');
    });
});
