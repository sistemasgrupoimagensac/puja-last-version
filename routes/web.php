<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\MyPostsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\ConfirmacionPagoAntesDeDebitar;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\CustomerCardController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\PlanController;
use App\Http\Middleware\SessionData;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\SuppliersController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\Web\Panel\PerfilController;
use App\Http\Controllers\Web\Panel\PasswordController;
use App\Http\Controllers\Web\Panel\MisAvisosController;
use App\Http\Controllers\Web\PanelProyecto\MisProyectosController;
use App\Http\Controllers\Web\PanelProyecto\PerfilProyectoController;
use App\Http\Controllers\Web\Panel\PlanesContratadosController;
use App\Http\Controllers\Web\Puja\MainController;
use App\Http\Controllers\ProyectoController;
use App\Models\Post;
use App\Http\Controllers\ProyectoImagenesPrincipalController;
use App\Http\Controllers\ProyectoImagenesAdicionalController;
use App\Http\Controllers\ProyectoImagenController;
use App\Http\Controllers\ProyectoImagenUnidadController;
use App\Http\Controllers\ProyectosController;
use App\Http\Controllers\UserProjectSubscriptionController;
use App\Http\Controllers\Web\PanelProyecto\ProyectoInteresadosController;
use App\Http\Controllers\Web\PanelProyecto\ProyectosContratadosController;
use App\Http\Middleware\CheckPaymentProjectStatus;
use App\Http\Controllers\RenovacionController;
use \App\Http\Middleware\CheckUserProjectType;

Route::get('/', MainController::class);
Route::get('/libro-reclamaciones', [SuppliersController::class, 'libroReclamos'])->name('libro_reclamaciones');

Route::middleware('auth')->group(function () {
    Route::get('/email/verify', [EmailVerificationController::class, 'notice'])
        ->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])
        ->middleware('signed')->name('verification.verify');
    Route::post('/email/verification-notification', [EmailVerificationController::class, 'send'])
        ->middleware('throttle:6,1')->name('verification.send');
});

// Autenticacion Google
Route::get('/google-auth/redirect', [SuppliersController::class, 'selectAccountGoogle']);
Route::get('/google-auth/callback', [SuppliersController::class, 'createLoginGoogle']);

// Filtros
Route::prefix('/inmuebles')->controller(App\Http\Controllers\Web\Puja\InmueblesController::class)->group(function() {
    Route::get('/{operacion}', 'busquedaInmuebles')->name('busqueda_inmuebles');
    Route::get('/filter/search', 'filterSearch')->name('filter_search');
});

// Mostrar Inmueble
Route::prefix('/inmueble')->name('inmueble.')->group(function() {
    Route::get('/{inmueble}', App\Http\Controllers\Web\Puja\InmuebleController::class)->name('single');
});

Route::middleware(['auth', 'verified', \App\Http\Middleware\BlockProjectUsers::class])->group(function() {
    Route::prefix('/panel')->name('panel.')->group(function() {
        Route::get('/', fn() => redirect()->route('panel.mis-avisos'));
        Route::get('/avisos', MisAvisosController::class)->name('mis-avisos');
        Route::get('/planes-contratados', PlanesContratadosController::class)->name('planes-contratados');
        Route::get('/perfil', PerfilController::class)->name('perfil');
        Route::get('/password', PasswordController::class)->name('password');
    });
});

Route::middleware(['guest'])->group(function() {
    Route::get('/recuperar-contrasena', [LoginController::class, 'forgot_password'])->name('auth.forgot-password.index');
    Route::post('/recuperar-contrasena', [LoginController::class, 'send_password'])->name('auth.forgot-password.send');
    Route::get('/reset-password/{token}', [LoginController::class, 'recovery_password'])->name('password.reset');
    Route::post('/reset-password', [LoginController::class, 'update_password'])->name('auth.password.reset.update');
});

Route::middleware('auth')->group(function () {
    Route::put('editar-perfil/{id}', [LoginController::class, 'editProfile'])->name('auth.edit-profile');
    Route::put('cambiar-contrasena/{id}', [LoginController::class, 'editPassword'])->name('auth.edit-password');
});

Route::get('/publica-tu-inmueble', [LoginController::class, 'select_profile'])->name('login.publica_tu_inmueble');
Route::get('/login', [LoginController::class, 'sign_in'])->name('sign_in');
Route::get('/register', [LoginController::class, 'register'])->name('login.register');
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::post('/store', [LoginController::class, 'store']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/recuperar-password', [LoginController::class, 'recovery_password'])->name('login.recovery_password');

Route::post('/store-completeUserGoogle', [LoginController::class, 'complete_user_google'])->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/my-posts/create', [MyPostsController::class, 'create'])->name('posts.create')->middleware('verified');
    Route::post('/my-post/store', [MyPostsController::class, 'store'])->name('posts.store');
    Route::put('/my-posts/description/edit', [MyPostsController::class, 'edit_description'])->name('posts.edit_description');
    Route::post('/my-posts/sold', [MyPostsController::class, 'my_post_sold']);
    Route::post('/my-post/delete', [MyPostsController::class, 'my_post_delete']);
    Route::get('/my-posts/{aviso}/edit', [MyPostsController::class, 'edit'])->name('posts.edit');
});

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

// Obtener imagenes
// Rutas imagenes para producción
Route::get('/images/{id_inmueble}/{archivo}', [ImagesController::class, 'get_images']);
Route::get('/planos/{id_inmueble}/{archivo}', [ImagesController::class, 'get_planos']);
Route::get('/videos/{id_inmueble}/{archivo}', [ImagesController::class, 'get_videos']);
Route::get('/pdf/{archivo}', [ImagesController::class, 'get_pdf']);
// Rutas para el entorno DEV
Route::get('wsb-dev/{name_dev}/images/{id_inmueble}/{archivo}', [ImagesController::class, 'dev_get_images']);
Route::get('wsb-dev/{name_dev}/planos/{id_inmueble}/{archivo}', [ImagesController::class, 'dev_get_planos']);
Route::get('wsb-dev/{name_dev}/videos/{id_inmueble}/{archivo}', [ImagesController::class, 'dev_get_videos']);

// Rutas imagenes de PROYECTOS producción

// Rutas imagenes de PROYECTOS para desarrollo
Route::get('wsb-dev/{name_dev}/proyectos/images/{id_proyecto}/{archivo}', [ImagesController::class, 'dev_get_project_images']);

// Rutas planos UNIDADES de PROYECTOS para desarrollo
Route::get('wsb-dev/{name_dev}/proyectos/unidades/{id_proyecto}/{id_unidad}/{archivo}', [ImagesController::class, 'dev_get_project_unidad_images']);

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
Route::post('/consulta-dni-ruc', [DocumentoController::class, 'consultar_dni_ruc']);

Route::post('/enviar-datos-dni-ruc', [BillingController::class, 'recibirDatos']);

// Procesar contacto interesado en un inmueble
Route::post('/procesar-contacto', [MyPostsController::class, 'procesar_contacto'])->name('procesar_contacto');

// Procesar contacto interesado en un proyecto
Route::post('/procesar-contacto-proyecto', [MyPostsController::class, 'procesar_contacto_proyecto'])->name('procesar_contacto_proyecto');

// Ruta de contacto
Route::get('/contacto', [ContactoController::class, 'index'])->name('contacto');
Route::post('/contacto', [ContactoController::class, 'store'])->name('post.contacto');

Route::get('/contacto/proyecto', [ContactoController::class, 'contacto_proyecto'])->name('contacto_proyecto');
Route::post('/contacto/proyecto', [ContactoController::class, 'contacto_lead_proyecto_store'])->name('contacto_lead_proyecto_store');

Route::fallback(function () {
    return view('errors.404');
});

// Blog posts
Route::get('/blog/{slug}', function ($slug) {
    $post = Post::where('slug', $slug)->where('is_published', true)->firstOrFail();
    
    // Si el post está publicado, se muestra la vista del post.
    return view('blog.post', compact('post'));
});

Route::get('/blog', function () {
    // Obtener todos los posts publicados
    $posts = Post::where('is_published', true)->latest()->get();
    
    // Retornar la vista de blog con todos los posts
    return view('blog.index', compact('posts'));
});

// Transaccion
Route::post('/save-transaction', [TransactionsController::class, 'store']);

// Proyectos ===================================================================================================================================
// Ruta para ver el formulario de creación de proyectos
Route::get('/proyecto/editor/{id?}', [ProyectoController::class, 'create'])->name('proyectos.create');

// Ruta para almacenar la información del proyecto
Route::post('/proyecto', [ProyectoController::class, 'store'])->name('proyecto.store');

// Ruta para subir imágenes PROYECTOS
Route::post('/proyectos/{proyectoId}/imagenes', [ProyectoImagenController::class, 'store'])->name('proyectos.imagenes.store');
Route::post('/proyectos/{proyectoId}/imagenes-principal', [ProyectoImagenController::class, 'updatePrincipal'])->name('proyectos.imagenes-principal.update');

// Ruta para eliminar imágenes PROYECTOS
Route::delete('/proyectos/{proyecto}/imagenes/{imagen}', [ProyectoImagenController::class, 'destroy'])->name('proyectos.imagenes.destroy');

// Ruta para visualizar un proyecto con URL amigable
Route::get('/proyecto/{slug}', [ProyectoController::class, 'show'])->name('proyecto.show');


Route::get('/proyectos', [ProyectosController::class, 'index'])->name('proyectos.index');
Route::get('/proyectos/{filtro}', [ProyectosController::class, 'filtrarProyectos'])->name('proyectos.filtrar');

Route::get('unidades/{unidadId}/imagenes', [ProyectoImagenUnidadController::class, 'index'])->name('unidad.imagenes');
Route::post('/unidades/{unidadId}/imagenes', [ProyectoImagenUnidadController::class, 'store'])->name('unidades.imagenes.store');
Route::delete('/unidades/imagenes/{imagenId}', [ProyectoImagenUnidadController::class, 'destroy']);


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
});

// Actualizar el estado de los interesados en un Proyecto
Route::post('/panel-proyecto/interesados/update-status', [ProyectoInteresadosController::class, 'updateStatus'])->name('interesados.update-status');

// Ruta para el pago de proyecto
// Route::get('/proyecto-pago', [PlanController::class, 'mostrarPagoProyecto'])->name('ruta.proyecto.pago');

Route::get('/proyecto-pago', [PlanController::class, 'mostrarPagoProyecto'])
    ->name('ruta.proyecto.pago')
    ->middleware(CheckPaymentProjectStatus::class);

// cmabiar estado a cliente pagó
Route::post('/save-paid-project-status', [ProyectoController::class, 'savePaidProjectStatus'])->name('paid.project');

// suscribir al cliente inmobiliario
// Route::post('/crear-plan', [PlanController::class, 'crearPlan'])->name('crear.plan');
Route::post('/crear_cliente', [PlanController::class, 'crearCliente'])->name('crear.cliente');
Route::post('/asociar_tarjeta', [PlanController::class, 'asociarTarjeta'])->name('asociar.tarjeta');
// Route::post('/suscribir_cliente', [PlanController::class, 'suscribirCliente'])->name('suscribir.cliente');

// guardar la suscription del cliente a su debito automatico
Route::post('/save-subscription-status', [PlanController::class, 'saveSubscriptionStatus'])->name('save.subscription.status');

Route::post('/guardar_tarjeta', [CustomerCardController::class, 'store'])->name('guardar_tarjeta');
Route::post('/suscribir_plan', [UserProjectSubscriptionController::class, 'suscribirPlan']);
Route::post('/realizar_debito_inicial', [PlanController::class, 'realizarDebitoInicial']);

Route::get('/contratos/{archivo}', [PDFController::class, 'getPDF'])->name('contratos.get');

// renovacion de planes
Route::post('/planes/renovacion/toggle', [RenovacionController::class, 'toggleRenovacion'])->name('planes.renovacion.toggle');

// para renovar
Route::get('/planes/renovacion/{plan_id}', [PlanController::class, 'showRenovacionPage'])->name('planes.renovacion');

// confirmacion de estado de pago antes de debitar
Route::post('/confirmacion_pago_proyecto', [ConfirmacionPagoAntesDeDebitar::class, 'check']);