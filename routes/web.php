<?php

use App\Http\Controllers\LoginController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::get('/', App\Http\Controllers\Web\Puja\MainController::class);

Route::get('/google-auth/redirect', function () {
    return Socialite::driver('google')
        ->with(['prompt' => 'select_account'])
        ->redirect();
});
 
Route::get('/google-auth/callback', function () {
    $user_google = Socialite::driver('google')->user();
    $existingUser = User::where('google_id', $user_google->id)->first();
    
    $user = User::updateOrCreate([
            'google_id' => $user_google->id,
        ],[
            'nombres' => $user_google->name,
            'email' => $user_google->email,
            'imagen' => $user_google->avatar,
    ]);

    Auth::login($user);
    if ($existingUser) {
        return redirect('/');
    } else {
        return redirect('/')->with('user', $user->toJson());
    }
});

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

Route::get('/sign-in/{profile_type}', function($profile_type) {
    return view('auth.signin', compact('profile_type'));
})->name("sign-in");

Route::post('/store', [LoginController::class, 'store']);
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register/{profile_type}', function($profile_type) {
    return view('auth.register', compact('profile_type'));
});

Route::get('/recuperar-password', function() {
    return view('auth.recoverpassword');
});