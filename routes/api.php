<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\InmueblesController;
use App\Http\Controllers\Api\MainController;
use App\Http\Controllers\Api\MisAvisosController;
use App\Http\Controllers\Api\SuppliersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/* Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum'); */

Route::post('/login', [AuthController::class, 'login']);
Route::post('/users', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/users/{user_id}/ads', [MisAvisosController::class, 'getUserAds']);
});

Route::prefix('/user')->group(function() {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/password-reset', [AuthController::class, 'sendPasswordResetLink']);


});

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('/user')->group(function() {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::put('/update-profile', [AuthController::class, 'updateProfile']);
        Route::put('/update-password', [AuthController::class, 'updatePassword']);
    });
});

Route::get('/main', MainController::class);
Route::get('/complaints-book', [SuppliersController::class, 'ComplaintsBook']);

// Filtros
Route::prefix('/immovables')->controller(InmueblesController::class)->group(function() {
    Route::get('/{operation}', 'searchImmovables');
    Route::get('/filter/search', 'filterSearch');
});

Route::prefix('/panel')->group(function() {
    Route::get('/ads', MisAvisosController::class);
    Route::get('/planes-contratados', PlanesContratadosController::class)->name('planes-contratados');
    Route::get('/perfil', PerfilController::class)->name('perfil');
    Route::get('/password', PasswordController::class)->name('password');
});