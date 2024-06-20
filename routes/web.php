<?php

use Illuminate\Support\Facades\Route;

Route::get('/', App\Http\Controllers\Web\Puja\MainController::class);

Route::prefix('/inmuebles')->controller(App\Http\Controllers\Web\Puja\InmueblesController::class)->group(function() {
    Route::get('/{operacion}', 'busquedaInmuebles')->name('busqueda_inmuebles');
    Route::get('/filter/search', 'filterSearch')->name('filter_search');
});

Route::prefix('/inmueble')->name('inmueble.')->group(function() {
    Route::get('/{inmueble}', App\Http\Controllers\Web\Puja\InmuebleController::class)->name('single');
});

// hasta aqui

// Route::get('/inmuebles', function() {
//     return view('inmuebles');
// });

Route::get('/publica-tu-inmueble', function() {
    return view('publicatuinmueble');
});

Route::get('/sign-in', function() {
    return view('auth.signin');
});

Route::get('/recuperar-password', function() {
    return view('auth.recoverpassword');
});

Route::get('/register', function() {
    return view('auth.register');
});