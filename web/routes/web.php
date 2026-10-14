<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DiseaseController;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\DetectionController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\DiseaseController as AdminDiseaseController;
use App\Http\Controllers\Admin\PlantController as AdminPlantController;
use App\Http\Controllers\Admin\RecipeController as AdminRecipeController;
use App\Http\Controllers\Admin\DetectionController as AdminDetectionController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

/*
|--------------------------------------------------------------------------
| Web Routes - Aplikasi Tanaman Herbal
|--------------------------------------------------------------------------
|
| Routes untuk halaman public (pengunjung) dan admin dashboard
|
*/

// ==================== PUBLIC ROUTES ====================
// Halaman Landing & Informasi
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [HomeController::class, 'submitContact'])->name('contact.submit');

// Direktori Penyakit (20 jenis penyakit)
Route::prefix('diseases')->name('diseases.')->group(function () {
    Route::get('/', [DiseaseController::class, 'index'])->name('index');
    Route::get('/{slug}', [DiseaseController::class, 'show'])->name('show');
});

// Database Tanaman Herbal
Route::prefix('plants')->name('plants.')->group(function () {
    Route::get('/', [PlantController::class, 'index'])->name('index');
    Route::get('/{id}', [PlantController::class, 'show'])->name('show');
});

// Racikan Obat Herbal
Route::prefix('recipes')->name('recipes.')->group(function () {
    Route::get('/', [RecipeController::class, 'index'])->name('index');
    Route::get('/{id}', [RecipeController::class, 'show'])->name('show');
});

// Fitur Deteksi Tanaman dengan ML
Route::prefix('detection')->name('detection.')->group(function () {
    Route::get('/', [DetectionController::class, 'index'])->name('index');
    Route::post('/upload', [DetectionController::class, 'upload'])->name('upload');
    Route::get('/result/{id}', [DetectionController::class, 'result'])->name('result');
    Route::get('/history', [DetectionController::class, 'history'])->name('history');

    // Mock endpoint untuk testing (akan dihapus saat ML sudah terintegrasi)
    Route::post('/{id}/mock', [DetectionController::class, 'mockDetection'])->name('mock');
});

// ==================== AUTHENTICATION ROUTES ====================
// Login Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Password Reset Routes
Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// Registration disabled - only admin can create users

// ==================== ADMIN ROUTES ====================
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard Admin
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    // Profile Admin
    Route::get('/profile', [AdminProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [AdminProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [AdminProfileController::class, 'updatePassword'])->name('profile.password');
    
    // Management Penyakit (CRUD)
    Route::resource('diseases', AdminDiseaseController::class);
    
    // Management Tanaman (CRUD + Gallery)
    Route::resource('plants', AdminPlantController::class);
    Route::post('/plants/{id}/images', [AdminPlantController::class, 'uploadImage'])->name('plants.images.store');
    Route::delete('/plants/{plantId}/images/{imageId}', [AdminPlantController::class, 'deleteImage'])->name('plants.images.destroy');
    
    // Management Racikan (CRUD dengan Ingredients & Steps)
    Route::resource('recipes', AdminRecipeController::class);
    
    // Management & Statistik Deteksi
    Route::prefix('detections')->name('detections.')->group(function () {
        Route::get('/', [AdminDetectionController::class, 'index'])->name('index');
        Route::get('/statistics', [AdminDetectionController::class, 'statistics'])->name('statistics');
        Route::get('/{id}', [AdminDetectionController::class, 'show'])->name('show');
        Route::delete('/{id}', [AdminDetectionController::class, 'destroy'])->name('destroy');
    });
});

// Fallback route to serve public storage files if symbolic link is missing on client environment
Route::get('/storage/{path}', function ($path) {
    if (\Illuminate\Support\Facades\Storage::disk('public')->exists($path)) {
        return \Illuminate\Support\Facades\Storage::disk('public')->response($path);
    }
    abort(404);
})->where('path', '.*');
