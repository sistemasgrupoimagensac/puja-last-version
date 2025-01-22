<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\InmueblesController;
use App\Http\Controllers\Api\MainController;
use App\Http\Controllers\Api\MisAvisosController;
use App\Http\Controllers\Api\MyPostsController;
use App\Http\Controllers\Api\PerfilController;
use App\Http\Controllers\Api\PlanController;
use App\Http\Controllers\Api\PlanesContratadosController;
use App\Http\Controllers\Api\SuppliersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/* Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum'); */

Route::post('/login', [AuthController::class, 'login']);
Route::post('/users', [AuthController::class, 'register']);

Route::prefix('/user')->group(function() {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/password-reset', [AuthController::class, 'sendPasswordResetLink']);


});

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('/user')->group(function() {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::put('/update-profile', [AuthController::class, 'updateProfile']);
        // Route::put('/update-password', [AuthController::class, 'updatePassword']);
    });
});

Route::get('/main', MainController::class);
Route::get('/complaints-book', [SuppliersController::class, 'ComplaintsBook']);

// Filtros
Route::prefix('/immovables')->controller(InmueblesController::class)->group(function() {
    Route::get('/{operation}', 'searchImmovables');
    Route::get('/filter/search', 'filterSearch');
});

Route::prefix('/immovables/{operation}')->controller([InmueblesController::class, 'searchImmovables']);
Route::prefix('/immovables/filter/search')->controller([InmueblesController::class, 'filterSearch']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/users/{user_id}/ads', [MisAvisosController::class, 'getUserAds']);
    Route::get('/users/{user_id}/plans', [PlanesContratadosController::class, 'getUserPlans']);
    Route::get('/profile', [PerfilController::class, 'profile']);
    Route::put('/users', [AuthController::class, 'updateUser']);
    Route::put('/update-password', [AuthController::class, 'updatePassword']);

    Route::post('/ads', [MyPostsController::class, 'store']);
    Route::put('/ads/description', [MyPostsController::class, 'updateAdDescription']);
    Route::put('ads/sell', [MyPostsController::class, 'sellAd']);
    Route::delete('/ads', [MyPostsController::class, 'deleteAd']);
    Route::put('/ads/cancel-activate', [MyPostsController::class, 'cancelOrActivateAd']);

    
    // Route::post('/users/{user_id}/plans', [PlanController::class, 'userPlans']);
    Route::post('/plans', [PlanController::class, 'hirePlanAd']);
    
});

Route::get('/operation/subtypes', [MyPostsController::class, 'subtypes']);
Route::get('/ubication/departments', [MyPostsController::class, 'departments']);
Route::get('/ubication/{department_id}/provinces', [MyPostsController::class, 'provinces']);
Route::get('/ubication/{province_id}/districts', [MyPostsController::class, 'districts']);
Route::get('/extras/{category_extra_id}', [MyPostsController::class, 'extras']);

Route::get('/plans', [PlanController::class, 'getPlans']);
Route::get('/plans/{plan_id}', [PlanController::class, 'getPlan']);



/* 
Route::get('/planes-inmobiliaria', [PlanController::class, 'index']);
Route::post('/planes-user', [PlanController::class, 'list_plans_user']);
Route::post('/pagar-planes-propietario', [PlanController::class, 'planes_propietario'])->name('pagar.planes_propietario');
Route::post('/pagar-planes-acreedor', [PlanController::class, 'planes_acreedor'])->name('pagar.planes_acreedor');

Route::post('/plans', [PlanController::class, 'getPlans'])->name('get_planes');
Route::post('/plan', [PlanController::class, 'getPlan'])->name('get_plan');

Route::post('/contratar_plan', [PlanController::class, 'post_ad']);
Route::post('/usar-plan', [PlanController::class, 'use_plan']);
 */



