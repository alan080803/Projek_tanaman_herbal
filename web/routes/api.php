<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlantDetectionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Plant Detection API Routes
Route::prefix('plant-detection')->group(function () {
    // Public routes
    Route::get('/', [PlantDetectionController::class, 'index']);
    Route::get('/statistics', [PlantDetectionController::class, 'statistics']);
    Route::get('/{id}', [PlantDetectionController::class, 'show']);
    
    // Protected routes (require authentication)
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/', [PlantDetectionController::class, 'store']);
        Route::delete('/{id}', [PlantDetectionController::class, 'destroy']);
    });
});
