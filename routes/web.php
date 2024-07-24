<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\MyPostsController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\AvisoController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\OpenSSLTestController;
use App\Http\Controllers\PlanController;
use App\Http\Middleware\SessionData;
use App\Http\Controllers\DocumentoController;


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

Route::middleware(['auth'])->group(function() {
    Route::prefix('/panel')->name('panel.')->group(function() {
        Route::get('/', fn() => redirect()->route('panel.mis-avisos'));
        Route::get('/avisos', App\Http\Controllers\Web\Panel\MisAvisosController::class)->name('mis-avisos');
        Route::get('/perfil', App\Http\Controllers\Web\Panel\PerfilController::class)->name('perfil');
        Route::get('/password', App\Http\Controllers\Web\Panel\PasswordController::class)->name('password');
    });
});

// hasta aqui

Route::get('/publica-tu-inmueble', function() {
    return view('publicatuinmueble');
});

Route::get('/sign-in', [LoginController::class, 'sign_in'])->name('sign_in');
Route::post('/store', [LoginController::class, 'store']);
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [LoginController::class, 'register'])->name('login.register');

Route::get('/recuperar-password', function() {
    return view('auth.recoverpassword');
});

Route::get('/my-posts', [MyPostsController::class, 'index'])->name('posts.index');
Route::get('/my-posts/create', [MyPostsController::class, 'create'])->name('posts.create');

// Ruta para guardar los campos faltantes del usuario logueado con Google
Route::post('/update-user-data', [MyPostsController::class, 'updateUserData'])->name('update.user.data');


Route::post('/my-post/store', [MyPostsController::class, 'store'])->name('posts.store');
// Route::get('/my-posts/{id}', [MyPostsController::class, 'show'])->name('posts.show');
Route::get('/my-posts/{aviso}/edit', [MyPostsController::class, 'edit'])->name('posts.edit');
// Route::put('/my-posts/{id}', [MyPostsController::class, 'update'])->name('posts.update');
// Route::delete('/my-posts/{id}', [MyPostsController::class, 'destroy'])->name('posts.destroy');

Route::get('/my-post/operaciones/subtipos', [MyPostsController::class, 'get_subtipos']);
Route::get('/my-post/ubicacion/departamentos', [MyPostsController::class, 'getDepartamentos']);
Route::get('/my-post/ubicacion/provincias/{departamentoId}', [MyPostsController::class, 'getProvincias']);
Route::get('/my-post/ubicacion/distritos/{provinciaId}', [MyPostsController::class, 'getDistritos']);
Route::get('/my-post/extras/{extra_id}', [MyPostsController::class, 'getExtras']);



// Ruta para planes de pago
Route::get('/planes-inmobiliaria', [App\Http\Controllers\PlanController::class, 'index']);
Route::post('/pagar-plan', [App\Http\Controllers\PlanController::class, 'pay_plan']);
Route::get('/planes-user', [App\Http\Controllers\PlanController::class, 'list_plans_user']);
/* Route::get('/planes-inmobiliaria', function() {
    try {

        return view('planes');

    } catch (\Throwable $th) {
        // Capturar cualquier excepción o error que ocurra y retornar una respuesta de error

        return response()->json([
            'http_code' => 500,
            'message' => 'Error al generar la factura',
            'error' => $th->getMessage() // Mensaje de error detallado
        ], 500); // Código de estado HTTP 500 (Internal Server Error)
    }
}); */

// Ruta landing de proyectos inmobiliarios
Route::get('/proyectos', function() {
    return view('landing-projects');
});

Route::get('/images/{archivo}', [ImagesController::class, 'get_images']);
Route::get('/videos/{archivo}', [ImagesController::class, 'get_videos']);


// Route::get('/openpay', [MyPostsController::class, 'openpay'])->middleware('sessiondata');
Route::post('/openpay/{id}', [BillingController::class, 'generarFactura'])->middleware(SessionData::class);

Route::get('/send_mail', [BillingController::class, 'sendMail']);


// Route::post('/pagar-planes-propietario', [PlanController::class, 'planes_propietario']);
Route::post('/pagar-planes-propietario', [PlanController::class, 'planes_propietario'])->name('pagar.planes_propietario');

Route::post('/contratar-plan', [PlanController::class, 'contratar_plan'])->name('contratar.plan');

// Ruta planes de prietario (dueño)
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


Route::post('/consultar-documento', [DocumentoController::class, 'consultar'])->name('consultar.documento');

Route::post('/enviar-datos-dni-ruc', [BillingController::class, 'recibirDatos']);
