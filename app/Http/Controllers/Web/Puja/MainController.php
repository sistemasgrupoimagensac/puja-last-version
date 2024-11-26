<?php

namespace App\Http\Controllers\Web\Puja;

use App\Http\Controllers\Controller;
use App\Models\Proyecto;
use App\Models\ProyectoCliente;
use App\Repositories\AvisoRepository;
use App\Repositories\TipoInmuebleRepository;
use App\Services\Aviso\ObtenerAvisosPrincipales;
use App\Services\TipoInmueble\ObtenerTiposInmuebles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\ProyectoImagenesAdicionales;

class MainController extends Controller
{
    public function __construct(protected AvisoRepository $repository_aviso, protected TipoInmuebleRepository $repository_tipoinmueble)
    {        
    }

    public function __invoke(Request $request)
    {
        $avisos = (new ObtenerAvisosPrincipales($this->repository_aviso))->__invoke();
        $tipos_inmuebles = (new ObtenerTiposInmuebles($this->repository_tipoinmueble))->__invoke();

        // Inicializar las variables
        $tienePlanes = false;
        $projectInfo = false;

        // Verificar si el usuario está autenticado
        if (Auth::check()) {
            $user_id = Auth::id();
            $user = User::find($user_id);
            $active_plan_users = $user->active_plans()->get();
            $tienePlanes = $active_plan_users->isNotEmpty();
            $projectInfo = $user->canPublishProjects(); 
        }

        // Obtener una imagen aleatoria con tipo = 1 de la tabla proyecto_imagenes_adicionales
        $imagenFondo = ProyectoImagenesAdicionales::where('tipo', 1)->inRandomOrder()->first();
        $proyecto = $imagenFondo ? Proyecto::where('id', $imagenFondo->proyecto_id)->first() : null;

        // Pasar la variable $imagenFondo y $projectInfo a la vista
        return view('home', compact('avisos', 'tipos_inmuebles', 'tienePlanes', 'imagenFondo', 'projectInfo', 'proyecto'));
    }
}
