<?php

use App\Models\User;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MyPostsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\PlanController;
use App\Http\Middleware\SessionData;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\Web\Panel\PerfilController;
use App\Http\Controllers\Web\Panel\PasswordController;
use App\Http\Controllers\Web\Panel\MisAvisosController;
use App\Http\Controllers\Web\Puja\MainController;


Route::get('/', MainController::class);

Route::get('/google-auth/redirect', function () {
    return Socialite::driver('google')
        ->with(['prompt' => 'select_account'])
        ->redirect();
});
 
Route::get('/google-auth/callback', function () {
    $user_google = Socialite::driver('google')->user();
    $profile_type = session('profile_type', 2); 
    $existingUser = User::where('google_id', $user_google->id)->first();

    if ($existingUser) {
        // Loguear al usuario existente
        Auth::login($existingUser);
        return redirect('/')->with('user', $existingUser->toJson());
    } else {
        // Crear un nuevo usuario
        $user = User::create([
            'google_id' => $user_google->id,
            'nombres' => $user_google->name,
            'email' => $user_google->email,
            'imagen' => $user_google->avatar,
            'tipo_usuario_id' => $profile_type,
        ]);

        // Loguear al nuevo usuario
        Auth::login($user);
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

Route::middleware(['auth'])->group(function() {
    Route::prefix('/panel')->name('panel.')->group(function() {
        Route::get('/', fn() => redirect()->route('panel.mis-avisos'));
        Route::get('/avisos', MisAvisosController::class)->name('mis-avisos');
        Route::get('/perfil', PerfilController::class)->name('perfil');
        Route::get('/password', PasswordController::class)->name('password');
    });
});

Route::get('/publica-tu-inmueble', function() {
    return view('publicatuinmueble');
});

Route::get('/sign-in', [LoginController::class, 'sign_in'])->name('sign_in');
Route::post('/store', [LoginController::class, 'store']);

// ruta de actualizacion de usuario logueado con google
Route::post('/store-completeUserGoogle', [LoginController::class, 'complete_user_google']);

Route::post('login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [LoginController::class, 'register'])->name('login.register');

Route::get('/recuperar-password', function() {
    return view('auth.recoverpassword');
});

Route::get('/my-posts', [MyPostsController::class, 'index'])->name('posts.index');
Route::get('/my-posts/create', [MyPostsController::class, 'create'])->name('posts.create');

Route::post('/my-post/store', [MyPostsController::class, 'store'])->name('posts.store');
// Route::get('/my-posts/{id}', [MyPostsController::class, 'show'])->name('posts.show');
Route::get('/my-posts/{aviso}/edit', [MyPostsController::class, 'edit'])->name('posts.edit');
Route::put('/my-posts/description/edit', [MyPostsController::class, 'edit_description'])->name('posts.edit_description');
Route::post('/my-posts/sold', [MyPostsController::class, 'my_post_sold']);
// Route::put('/my-posts/{id}', [MyPostsController::class, 'update'])->name('posts.update');
// Route::delete('/my-posts/{id}', [MyPostsController::class, 'destroy'])->name('posts.destroy');

Route::get('/my-post/operaciones/subtipos', [MyPostsController::class, 'get_subtipos']);
Route::get('/my-post/ubicacion/departamentos', [MyPostsController::class, 'getDepartamentos']);
Route::get('/my-post/ubicacion/provincias/{departamentoId}', [MyPostsController::class, 'getProvincias']);
Route::get('/my-post/ubicacion/distritos/{provinciaId}', [MyPostsController::class, 'getDistritos']);
Route::get('/my-post/extras/{extra_id}', [MyPostsController::class, 'getExtras']);



// Ruta para planes de pago
Route::get('/planes-inmobiliaria', [PlanController::class, 'index']);
Route::post('/planes-user', [PlanController::class, 'list_plans_user']);
Route::post('/pagar-planes-propietario', [PlanController::class, 'planes_propietario'])->name('pagar.planes_propietario');
Route::post('/pagar-planes-acreedor', [PlanController::class, 'planes_acreedor'])->name('pagar.planes_acreedor');

Route::post('/contratar_plan', [PlanController::class, 'post_ad']);
Route::post('/usar-plan', [PlanController::class, 'use_plan']);

// Ruta landing de proyectos inmobiliarios
Route::get('/proyectos', function() {
    return view('landing-projects');
});

Route::get('/images/{archivo}', [ImagesController::class, 'get_images']);
Route::get('/videos/{archivo}', [ImagesController::class, 'get_videos']);
Route::get('/pdf/{archivo}', [ImagesController::class, 'get_pdf']);


// Route::get('/openpay', [MyPostsController::class, 'openpay'])->middleware('sessiondata');
Route::post('/generarComprobanteElec/{id}', [BillingController::class, 'generarFactura'])->middleware(SessionData::class);

Route::get('/send_mail', [BillingController::class, 'sendMail']);

// Ruta planes del propietario (dueño)
Route::get('/planes-propietario', function() {
    return view('planes-propietario');
});

// Ruta Terminos de contratacion
Route::get('/terminos-contratacion', function() {
    return view('legal/terminos-contratacion');
});

// Ruta Terminos de uso
Route::get('/terminos-uso', function() {
    return view('legal/terminos-uso');
});

// Ruta politicas de privacidad
Route::get('/politica-privacidad', function() {
    return view('legal/politica-privacidad');
});


Route::post('/get-data-openpay', [PlanController::class, 'get_data_openpay']);
Route::post('/pagar-openpay', [PlanController::class, 'pay_openpay']);
// Route::post('/consultar-documento', [DocumentoController::class, 'consultar'])->name('consultar.documento');
Route::post('/consulta-dni-ruc', [DocumentoController::class, 'consultar_dni_ruc']);

Route::post('/enviar-datos-dni-ruc', [BillingController::class, 'recibirDatos']);



Route::post('/enviar-datos-contacto', [MyPostsController::class, 'enviar_datos_contacto'])->name('email.enviar-datos_contacto');