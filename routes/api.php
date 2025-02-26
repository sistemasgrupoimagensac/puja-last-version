<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AvisoLikeController;
use App\Http\Controllers\Api\ConfirmacionPagoAntesDeDebitar;
use App\Http\Controllers\Api\ContactoController;
use App\Http\Controllers\Api\CustomerCardController;
use App\Http\Controllers\Api\EmailVerificationController;
use App\Http\Controllers\Api\InmuebleController;
use App\Http\Controllers\Api\InmueblesController;
use App\Http\Controllers\Api\MainController;
use App\Http\Controllers\Api\MisAvisosController;
use App\Http\Controllers\Api\MisProyectosController;
use App\Http\Controllers\Api\MyPostsController;
use App\Http\Controllers\Api\PDFController;
use App\Http\Controllers\Api\PerfilController;
use App\Http\Controllers\Api\PlanController;
use App\Http\Controllers\Api\PlanesContratadosController;
use App\Http\Controllers\Api\ProyectoController;
use App\Http\Controllers\Api\ProyectoImagenUnidadController;
use App\Http\Controllers\Api\ProyectoInteresadosController;
use App\Http\Controllers\Api\ProyectosContratadosController;
use App\Http\Controllers\Api\ProyectosController;
use App\Http\Controllers\Api\RenovacionController;
use App\Http\Controllers\Api\SuppliersController;
use App\Http\Controllers\Api\UserProjectSubscriptionController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\TransactionsController;
use App\Http\Middleware\SessionData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/* Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum'); */

Route::get('/main', MainController::class);
Route::get('/tipos-inmuebles', [MainController::class, 'tiposInmuebles']);
Route::get('/tipos-operacion', [MainController::class, 'tiposOperacion']);
// Route::get('/complaints-book', [SuppliersController::class, 'ComplaintsBook']);

Route::get('/inmuebles/filter/search', [InmueblesController::class, 'filterSearch']);
Route::get('/inmuebles/{operation}', [InmueblesController::class, 'searchImmovables']);
Route::get('/adicionales', [InmueblesController::class, 'getCaracteristicas']);
Route::get('/comodidades', [InmueblesController::class, 'getComodidades']);

Route::post('/inmueble/whatsapp-contact', [ContactoController::class, 'whatsappContact']);
Route::post('/inmueble/email-contact', [ContactoController::class, 'emailContact']);
Route::get('/inmueble/{inmueble}', InmuebleController::class);
Route::get('/blogs',[SuppliersController::class, 'indexBlog']);
Route::get('/blogs/{slug}',[SuppliersController::class, 'showBlog']);
Route::get('/landing-count',[SuppliersController::class, 'landingCount']);

/* Route::middleware('auth')->group(function () {
    Route::get('/email/verify', [EmailVerificationController::class, 'notice'])
        ->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])
        ->middleware('signed')->name('verification.verify');
    Route::post('/email/verification-notification', [EmailVerificationController::class, 'send'])
        ->middleware('throttle:6,1')->name('verification.send');
}); */

/* Route::get('/google-auth/redirect', [SuppliersController::class, 'selectAccountGoogle']);
Route::get('/google-auth/callback', [SuppliersController::class, 'createLoginGoogle']); */

/* Route::middleware(['guest'])->group(function() {
    Route::get('/recuperar-contrasena', [LoginController::class, 'forgot_password'])->name('auth.forgot-password.index');
    Route::post('/recuperar-contrasena', [LoginController::class, 'send_password'])->name('auth.forgot-password.send');
    Route::get('/reset-password/{token}', [LoginController::class, 'recovery_password'])->name('password.reset');
    Route::post('/reset-password', [LoginController::class, 'update_password'])->name('auth.password.reset.update');
}); */

Route::get('/login-image-type', [AuthController::class, 'sign_in']);
Route::get('/users/types', [AuthController::class, 'userTypes']);
Route::get('/tipos-documento-identidad', [AuthController::class, 'tiposDocuemntosIDentidad']);

Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/users', [AuthController::class, 'register']);
Route::post('/recuperar-contrasena', [AuthController::class, 'sendPasswordResetLink']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/auth/logout', [AuthController::class, 'logout']);

    Route::patch('/users/{id}', [AuthController::class, 'update']);
    Route::patch('/users/{id}/update-password', [AuthController::class, 'updatePassword']);
    Route::get('/users/{id}', [AuthController::class, 'show']);

    Route::post('/email/verification-notification', [EmailVerificationController::class, 'send']);
    
    Route::post('/avisos/{aviso}/like', [AvisoLikeController::class, 'toggleLike']);
    
    Route::get('/users/{id}/ads', [MisAvisosController::class, 'getUserAds']);
    Route::get('/users/{id}/plans', [PlanController::class, 'getUserPlans']);
    Route::post('/plans/subscribe', [PlanController::class, 'hirePlanAd']); // Falta probar
    
    Route::post('/ads', [MyPostsController::class, 'store']);
    Route::put('/ads/description', [MyPostsController::class, 'updateAdDescription']);
    Route::put('ads/sell', [MyPostsController::class, 'sellAd']);
    Route::delete('/ads', [MyPostsController::class, 'deleteAd']);
    Route::put('/ads/cancel-activate', [MyPostsController::class, 'cancelOrActivateAd']);
    
    Route::post('/cpe/{plan_user_id}', [BillingController::class, 'generarFactura'])->middleware(SessionData::class); // Mismo metodo

    Route::post('/openpay/data', [PlanController::class, 'getOpenpayData']);
    Route::post('/openpay', [PlanController::class, 'pay']); // Falta probar
    Route::post('/openpay/save-transaction', [TransactionsController::class, 'store']); // Falta probar

    Route::post('/consult-document', [DocumentoController::class, 'consultar_dni_ruc']);
    
    Route::post('/users/{user}/projects', [ProyectoController::class, 'store']);  // Falta probar
    Route::post('/save-paid-project-status', [ProyectoController::class, 'savePaidProjectStatus']); // Falta probar

    Route::post('/unidades/{unidadId}/imagenes', [ProyectoImagenUnidadController::class, 'store']); // Falta probar
    Route::delete('/unidades/imagenes/{imagenId}', [ProyectoImagenUnidadController::class, 'destroy']); // Falta probar
    
    
    Route::get('/panel-proyecto/proyectos-contratados', ProyectosContratadosController::class)->name('proyectos-contratados'); // Falta probar
    Route::post('/contactar-plan-proyecto', [ProyectosContratadosController::class, 'contactarPlanProyecto']); // Falta probar
    Route::post('/panel-proyecto/interesados/update-status', [ProyectoInteresadosController::class, 'updateStatus']); // Falta probar

    Route::get('/contratos/{archivo}', [PDFController::class, 'getPDF'])->name('contratos.get'); // Falta probar
    Route::post('/planes/renovacion/toggle', [RenovacionController::class, 'toggleRenovacion']); // Falta probar

});

Route::get('/project/banks', [ProyectoController::class, 'banks']);
Route::get('/project/progress', [ProyectoController::class, 'progress']);
Route::get('/project/{id}', [ProyectoController::class, 'show']);

Route::get('/proyectos', [ProyectosController::class, 'index']);
Route::get('/proyectos/{filtro}', [ProyectosController::class, 'filtrarProyectos']);

Route::get('unidades/{unidadId}/imagenes', [ProyectoImagenUnidadController::class, 'index']);

Route::get('panel-proyecto/proyectos', MisProyectosController::class);
// Route::get('panel-proyecto/perfil', PerfilController::class);
Route::get('panel-proyecto/interesados', ProyectoInteresadosController::class);
// Route::get('panel-proyecto/password', PasswordController::class);

Route::get('/proyecto-pago', [PlanController::class, 'mostrarPagoProyecto']);
Route::post('/crear-cliente', [PlanController::class, 'crearCliente']);
Route::post('/asociar-tarjeta', [PlanController::class, 'asociarTarjeta']); // Falta probar

// Route::post('/save-subscription-status', [PlanController::class, 'saveSubscriptionStatus']);
Route::post('/guardar_tarjeta', [CustomerCardController::class, 'store']); // Falta probar
Route::post('/suscribir_plan', [UserProjectSubscriptionController::class, 'suscribirPlan']); // Falta probar
Route::post('/realizar_debito', [PlanController::class, 'realizarDebito']); // Falta probar

// Route::get('/planes/renovacion/{plan_id}', [PlanController::class, 'showRenovacionPage']);
Route::post('/confirmacion_pago_proyecto', [ConfirmacionPagoAntesDeDebitar::class, 'check']); // Falta probar
// Route::post('/crear_plan_user_proyectos', [PlanController::class, 'crearPlanUserProyectos']);



Route::get('/inmuebles-subtipos', [MyPostsController::class, 'subtypes']);
Route::get('/ubicacion/departamentos', [MyPostsController::class, 'departments']);
Route::get('/ubicacion/{departamento_id}/provincias', [MyPostsController::class, 'provinces']);
Route::get('/ubicacion/{provincia_id}/distritos', [MyPostsController::class, 'districts']);
Route::get('/extras/{category_extra_id}', [MyPostsController::class, 'extras']);

Route::get('/plans', [PlanController::class, 'getPlans']);
Route::get('/plans/{plan_id}', [PlanController::class, 'getPlan']);

Route::post('/process-contact/{tipo_contacto}', [MyPostsController::class, 'processContact']); // Falta probar
Route::post('/procesar-contacto-proyecto', [MyPostsController::class, 'procesar_contacto_proyecto']); // Falta probar





// Route::post('/send-information', [ContactoController::class, 'store']); // Falta probar
// Route::post('/send-information/project', [ContactoController::class, 'contacto_lead_proyecto_store']); // Falta probar











