<?php

use App\Http\Controllers\AnuncioController;
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

// Route::get('testalpine', function () {
//     return view('TEST_ALPINE');
// });

Route::get('/crear-anuncio', [AnuncioController::class, 'create'])->name('anuncios.create');
Route::post('/guardar-anuncio/paso1', [AnuncioController::class, 'storePaso1'])->name('anuncios.store.paso1');
Route::post('/guardar-anuncio/paso2/{id}', [AnuncioController::class, 'storePaso2'])->name('anuncios.store.paso2');
Route::post('/guardar-anuncio/paso3/{id}', [AnuncioController::class, 'storePaso3'])->name('anuncios.store.paso3');