<?php

use Illuminate\Support\Facades\Route;

Route::get('/', App\Http\Controllers\Web\Puja\MainController::class);
Route::prefix('/inmuebles')->group(function() {
    Route::get('/{operacion}', App\Http\Controllers\Web\Puja\InmueblesController::class);
});