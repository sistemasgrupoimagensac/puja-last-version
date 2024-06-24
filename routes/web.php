<?php

use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\LoginController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
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

Route::prefix('/inmuebles')->controller(App\Http\Controllers\Web\Puja\InmueblesController::class)->group(function() {
    Route::get('/{operacion}', 'busquedaInmuebles')->name('busqueda_inmuebles');
    Route::get('/filter/search', 'filterSearch')->name('filter_search');
});

Route::prefix('/inmueble')->name('inmueble.')->group(function() {
    Route::get('/{inmueble}', App\Http\Controllers\Web\Puja\InmuebleController::class)->name('single');
});

Route::prefix('/panel')->name('panel.')->group(function() {
    Route::get('/', fn() => redirect()->route('panel.mis-avisos'));
    Route::get('/avisos', App\Http\Controllers\Web\Panel\MisAvisosController::class)->name('mis-avisos');
    Route::get('/perfil', App\Http\Controllers\Web\Panel\PerfilController::class)->name('perfil');
    Route::get('/password', App\Http\Controllers\Web\Panel\PasswordController::class)->name('password');
});

// hasta aqui

Route::get('/publica-tu-inmueble', function() {
    return view('publicatuinmueble');
});

Route::get('/sign-in', function() {
    return view('auth.signin');
})->name("sign-in");


Route::post('/store', [LoginController::class, 'store']);
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/recuperar-password', function() {
    return view('auth.recoverpassword');
});

Route::get('/register', function() {
    return view('auth.register');
});

// rutas de la creacion del aviso
use App\Http\Controllers\AvisoController;

Route::get('/crear-aviso', [AvisoController::class, 'create'])->name('avisos.create');
Route::post('/guardar-aviso/paso1', [AvisoController::class, 'storePaso1'])->name('avisos.store.paso1');
Route::post('/guardar-aviso/paso2/{id}', [AvisoController::class, 'storePaso2'])->name('avisos.store.paso2');
Route::post('/guardar-aviso/paso3/{id}', [AvisoController::class, 'storePaso3'])->name('avisos.store.paso3');
Route::post('/guardar-aviso/paso4/{id}', [AvisoController::class, 'storePaso4'])->name('avisos.store.paso4');
Route::post('/guardar-aviso/paso5/{id}', [AvisoController::class, 'storePaso5'])->name('avisos.store.paso5');
Route::post('/guardar-aviso/paso6/{id}', [AvisoController::class, 'storePaso6'])->name('avisos.store.paso6');
