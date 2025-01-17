<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Proyecto;
use App\Models\ProyectoImagenesAdicionales;
use App\Models\User;
use App\Repositories\AvisoRepository;
use App\Repositories\TipoInmuebleRepository;
use App\Services\Aviso\ObtenerAvisosPrincipales;
use App\Services\TipoInmueble\ObtenerTiposInmuebles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function __construct(
        protected AvisoRepository $repository_aviso,
        protected TipoInmuebleRepository $repository_tipoinmueble)
    {        
    }

    public function __invoke(Request $request)
    {
        $avisos = (new ObtenerAvisosPrincipales($this->repository_aviso))->__invoke();
        $tipos_inmuebles = (new ObtenerTiposInmuebles($this->repository_tipoinmueble))->__invoke();

        $tienePlanes = false;
        $projectInfo = false;

        if ( $request->user_id ) {
            $user = User::findOrFail($request->user_id);
            $tienePlanes = $user->active_plans()->exists();
            $projectInfo = $user->canPublishProjects(); 
        }

        $proyectoImgs = ProyectoImagenesAdicionales::where('tipo', 1)->inRandomOrder()->first();
        $proyectoImg = $proyectoImgs ? Proyecto::where('id', $proyectoImgs->proyecto_id)->first() : null;
        
        return response()->json([
            'message' => 'Datos de inicio.',
            'status' => 'success',
            'avisos' => $avisos,
            'tipos_inmuebles' => $tipos_inmuebles,
            'tienePlanes' => $tienePlanes,
            'proyectoImgs' => $proyectoImgs,
            'projectInfo' => $projectInfo,
            'proyectoImg' => $proyectoImg,
        ]);
    }
}
