<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\InmueblesController;
use App\Http\Controllers\Api\MainController;
use App\Http\Controllers\Api\MisAvisosController;
use App\Http\Controllers\Api\MisProyectosController;
use App\Http\Controllers\Api\MyPostsController;
use App\Http\Controllers\Api\PerfilController;
use App\Http\Controllers\Api\PlanController;
use App\Http\Controllers\Api\PlanesContratadosController;
use App\Http\Controllers\Api\ProyectoController;
use App\Http\Controllers\Api\ProyectoImagenUnidadController;
use App\Http\Controllers\Api\ProyectoInteresadosController;
use App\Http\Controllers\Api\ProyectosContratadosController;
use App\Http\Controllers\Api\ProyectosController;
use App\Http\Controllers\Api\SuppliersController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\TransactionsController;
use App\Http\Middleware\SessionData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/* Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum'); */

Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/users', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::post('/auth/password-reset', [AuthController::class, 'sendPasswordResetLink']);

    Route::patch('/users/{id}', [AuthController::class, 'update']);
    Route::patch('/users/{id}/update-password', [AuthController::class, 'updatePassword']);
    Route::get('/users/{id}', [AuthController::class, 'show']);
    
    Route::post('/users/{id}/ads', [MisAvisosController::class, 'getUserAds']);
    Route::get('/users/{id}/plans', [PlanController::class, 'getUserPlans']);
    Route::post('/plans/subscribe', [PlanController::class, 'hirePlanAd']);
    
    Route::post('/ads', [MyPostsController::class, 'store']);
    Route::put('/ads/description', [MyPostsController::class, 'updateAdDescription']);
    Route::put('ads/sell', [MyPostsController::class, 'sellAd']);
    Route::delete('/ads', [MyPostsController::class, 'deleteAd']);
    Route::put('/ads/cancel-activate', [MyPostsController::class, 'cancelOrActivateAd']);
    
    Route::post('/cpe/{plan_user_id}', [BillingController::class, 'generarFactura'])->middleware(SessionData::class); // Mismo metodo

    Route::post('/openpay', [PlanController::class, 'pay']);
    Route::post('/openpay/data', [PlanController::class, 'getOpenpayData']);
    Route::post('/openpay/save-transaction', [TransactionsController::class, 'store']);

    
    Route::post('/consult-document', [DocumentoController::class, 'consultar_dni_ruc']);



    
    Route::post('/users/{user}/projects', [ProyectoController::class, 'store']);
    Route::post('/save-paid-project-status', [ProyectoController::class, 'savePaidProjectStatus']);

    Route::post('/unidades/{unidadId}/imagenes', [ProyectoImagenUnidadController::class, 'store']);
    Route::delete('/unidades/imagenes/{imagenId}', [ProyectoImagenUnidadController::class, 'destroy']);
    
    
    Route::get('/panel-proyecto/proyectos-contratados', ProyectosContratadosController::class)->name('proyectos-contratados');
    
});
Route::get('/project/banks', [ProyectoController::class, 'banks']);
Route::get('/project/progress', [ProyectoController::class, 'progress']);
Route::get('/project/{id}', [ProyectoController::class, 'show']);

Route::get('/proyectos', [ProyectosController::class, 'index']);
Route::get('/proyectos/{filtro}', [ProyectosController::class, 'filtrarProyectos']);

Route::get('unidades/{unidadId}/imagenes', [ProyectoImagenUnidadController::class, 'index']);

Route::get('panel-proyecto', [ProyectoImagenUnidadController::class, 'index']);
Route::get('panel-proyecto/proyectos', MisProyectosController::class);
// Route::get('panel-proyecto/perfil', PerfilController::class);
Route::get('panel-proyecto/interesados', ProyectoInteresadosController::class);


/* 
Route::middleware(['auth', 'verified', CheckUserProjectType::class])->group(function() {
    Route::prefix('/panel-proyecto')->name('panel.proyecto.')->group(function() {
        Route::get('/', fn() => redirect()->route('panel.proyecto.mis-proyectos'));
        Route::get('/proyectos', MisProyectosController::class)->name('mis-proyectos');
        // Ruta para perfil del proyecto
        Route::get('/perfil', PerfilController::class)->name('perfil');
        Route::get('/proyectos-contratados', ProyectosContratadosController::class)->name('proyectos-contratados');
        Route::get('/interesados', ProyectoInteresadosController::class)->name('interesados');
        // Si tienes cambiar contraseña para proyectos, puedes agregarlo aquí
        Route::get('/password', PasswordController::class)->name('password');
    });
}); */




Route::prefix('/immovables/{operation}')->controller([InmueblesController::class, 'searchImmovables']);
Route::prefix('/immovables/filter/search')->controller([InmueblesController::class, 'filterSearch']);

Route::get('/operation/subtypes', [MyPostsController::class, 'subtypes']);
Route::get('/ubication/departments', [MyPostsController::class, 'departments']);
Route::get('/ubication/{department_id}/provinces', [MyPostsController::class, 'provinces']);
Route::get('/ubication/{province_id}/districts', [MyPostsController::class, 'districts']);
Route::get('/extras/{category_extra_id}', [MyPostsController::class, 'extras']);

Route::get('/plans', [PlanController::class, 'getPlans']);
Route::get('/plans/{plan_id}', [PlanController::class, 'getPlan']);

Route::post('/process-contact', [MyPostsController::class, 'processContact']);
Route::post('/procesar-contacto-proyecto', [MyPostsController::class, 'procesar_contacto_proyecto']);



Route::get('/main', MainController::class);
Route::get('/complaints-book', [SuppliersController::class, 'ComplaintsBook']);

Route::post('/send-information', [ContactoController::class, 'store']);
Route::post('/send-information/project', [ContactoController::class, 'contacto_lead_proyecto_store']);

Route::get('/blogs',[SuppliersController::class, 'indexBlog']);
Route::get('/blogs/{slug}',[SuppliersController::class, 'showBlog']);













/* 
    
    

 */

