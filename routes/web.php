<?php

use Illuminate\Support\Facades\Route;

Route::get('/', App\Http\Controllers\Web\Puja\MainController::class);
Route::prefix('/inmuebles')->group(function() {
    Route::get('/{operacion}', App\Http\Controllers\Web\Puja\InmueblesController::class);
});

Route::get('/inmuebles', function() {
    return view('inmuebles');
});

Route::get('/inmueble', [App\Http\Controllers\InmuebleController::class, 'index'])->name('inmueble');

Route::get('/publica-tu-inmueble', function() {
    return view('publicatuinmueble');
});

Route::get('/sign-in', function() {
    return view('auth.signin');
});