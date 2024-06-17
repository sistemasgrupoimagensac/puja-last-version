<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', App\Http\Controllers\Web\Puja\MainController::class);

Route::prefix('/inmuebles')->group(function() {
    Route::get('/{operacion}', App\Http\Controllers\Web\Puja\InmueblesController::class)->name('busqueda_inmuebles');
});

Route::prefix('/inmueble')->name('inmueble.')->group(function() {
    Route::get('/{inmueble}', App\Http\Controllers\Web\Puja\InmuebleController::class)->name('single');
});

// hasta aqui

Route::get('/inmuebles', function() {
    return view('inmuebles');
});

Route::get('/publica-tu-inmueble', function() {
    return view('publicatuinmueble');
});

Route::get('/sign-in', function() {
    return view('auth.signin');
});


Route::post('/store', [LoginController::class, 'store']);
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');