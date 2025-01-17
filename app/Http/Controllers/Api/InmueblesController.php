<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Caracteristica;
use App\Models\User;
use App\Repositories\AvisoRepository;
use App\Repositories\TipoInmuebleRepository;
use App\Repositories\TipoOperacionRepository;
use App\Services\Aviso\FiltrarAvisos;
use App\Services\TipoInmueble\ObtenerTiposInmuebles;
use App\Services\Url\ParsearUrl;
use Illuminate\Http\Request;

class InmueblesController extends Controller
{
    public function __construct(
        protected AvisoRepository $repository,
        protected TipoInmuebleRepository $tipo_inmueble_repository,
        protected TipoOperacionRepository $tipo_operacion_repository
        )
    {
    }

    public function searchImmovables(Request $request, $operation)
    {
        $url_parse = (new ParsearUrl($this->tipo_inmueble_repository, $this->tipo_operacion_repository))->forFilter($operation);
        $tipos_inmuebles = (new ObtenerTiposInmuebles($this->tipo_inmueble_repository))->__invoke();
        $avisos = (new FiltrarAvisos($this->repository))->__invoke($url_parse, $request);

        $caracteristicas = Caracteristica::where('categoria_caracteristica_id', 1)->get();
        $comodidades = Caracteristica::where('categoria_caracteristica_id', 2)->get();
        
        $tienePlanes = false;
        $projectInfo = false;
        if ( $request->user_id ) {
            $user = User::findOrFail($request->user_id);
            $tienePlanes = $user->active_plans()->exists();
            $projectInfo = $user->canPublishProjects(); 
        }

        return response()->json([
            'message' => 'Búsqueda.',
            'status' => 'success',
            'avisos' => $avisos,
            'url_parse' => $url_parse,
            'tipos_inmuebles' => $tipos_inmuebles,
            'tienePlanes' => $tienePlanes,
            'caracteristicas' => $caracteristicas,
            'comodidades' => $comodidades,
            'projectInfo' => $projectInfo,
        ]);
    }

    public function filterSearch(Request $request)
    {
        $request->validate([
            'category' => 'required',
            'transaction' => 'required',
            'address' => 'string',
        ]);

        $url_string = (new ParsearUrl($this->tipo_inmueble_repository, $this->tipo_operacion_repository))->makeUrl(tipo_inmueble: $request->categoria, tipo_operacion: $request->transaccion, direccion: $request->direccion);

        return response()->json([
            'message' => 'Búsqueda filtrada.',
            'status' => 'success',
            'operation' => $url_string,
        ]);
    }
}
