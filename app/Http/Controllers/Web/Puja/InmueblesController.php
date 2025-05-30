<?php

namespace App\Http\Controllers\Web\Puja;

use App\Http\Controllers\Controller;
use App\Models\Caracteristica;
use App\Repositories\AvisoRepository;
use App\Repositories\TipoInmuebleRepository;
use App\Repositories\TipoOperacionRepository;
use App\Services\Aviso\FiltrarAvisos;
use App\Services\Url\ParsearUrl;
use App\Services\TipoInmueble\ObtenerTiposInmuebles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class InmueblesController extends Controller
{
    public function __construct(
        protected AvisoRepository $repository,
        protected TipoInmuebleRepository $tipo_inmueble_repository,
        protected TipoOperacionRepository $tipo_operacion_repository
        )
    {
    }

    public function busquedaInmuebles(Request $request, $operacion)
    {
        $url_parse = (new ParsearUrl($this->tipo_inmueble_repository, $this->tipo_operacion_repository))->forFilter($operacion);
        $tipos_inmuebles = (new ObtenerTiposInmuebles($this->tipo_inmueble_repository))->__invoke();
        $avisos = (new FiltrarAvisos($this->repository))->__invoke($url_parse, $request);

        $caracteristicas = Caracteristica::where('categoria_caracteristica_id', 1)->get();
        $comodidades = Caracteristica::where('categoria_caracteristica_id', 2)->get();
        
        $tienePlanes = false;
        $projectInfo = false;
        if (Auth::check()) {
            $user_id = Auth::id();
            $user = User::find($user_id);
            $active_plan_users = $user->active_plans()->get();
            $tienePlanes = $active_plan_users->isNotEmpty();
            $projectInfo = $user->canPublishProjects(); 
        }

        $key_word = null;

        if ( $operacion === "inmuebles-en-venta" ) {
            $key_word = "Propiedades e inmuebles en venta en Lima";
        } else if ( $operacion === "inmuebles-en-venta-y-alquiler" ) {
            $key_word = "Inmuebles en Venta y en Alquiler";
        } else if ( $operacion === "casas-en-venta" ) {
            $key_word = "Casas en Venta";
        } else if ( $operacion === "departamentos-en-venta" || $operacion === "departamentos-en-venta-en-lima") {
            $key_word = "Departamentos en Venta en Lima";
        } else if ( $operacion === "inmuebles-en-remate" ) {
            $key_word = "Remates en Subasta, en Lima";
        } else if ( $operacion === "oficinas-en-venta" ) {
            $key_word = "Oficinas en Venta en Lima";
        } else if ( $operacion === "inmuebles-en-alquiler" ) {
            $key_word = "Propiedades en Alquiler en Lima";
        } else if ( $operacion === "terrenos-en-venta" ) {
            $key_word = "Terrenos en Venta en Lima";
        } else if ( $operacion === "departamentos-en-venta-en-chiclayo" ) {
            $key_word = "Departamento a la Venta en Chiclayo";
        } else if ( $operacion === "casas-en-venta-y-alquiler" ) {
            $key_word = "Casas en Venta y en Alquiler";
        } else if ( $operacion === "departamentos-en-venta-y-alquiler" ) {
            $key_word = "Departamentos en Venta y en Alquiler";
        } else if ( $operacion === "oficinas-en-venta-y-alquiler" ) {
            $key_word = "Oficinas en Venta y en Alquiler";
        } else if ( $operacion === "terrenos-en-venta-y-alquiler" ) {
            $key_word = "Terrenos en Venta y en Alquiler";
        } else if ( $operacion === "locales-en-venta-y-alquiler" ) {
            $key_word = "Locales en Venta y en Alquiler";
        } else if ( strpos($operacion, "venta") !== false ) {
            $key_word = "Propiedades en Venta";
        } else if ( strpos($operacion, "alquiler") !== false ) {
            $key_word = "Propiedades en Alquiler";
        } else if ( strpos($operacion, "remate") !== false ) {
            $key_word = "Propiedades en Subasta";
        }

        return view('inmuebles', compact('avisos', 'url_parse', 'tipos_inmuebles', 'tienePlanes', 'caracteristicas', 'comodidades', 'projectInfo', 'key_word'));
    }

    public function filterSearch(Request $request)
    {
        $url_string = (new ParsearUrl($this->tipo_inmueble_repository, $this->tipo_operacion_repository))->makeUrl(tipo_inmueble: $request->categoria, tipo_operacion: $request->transaccion, direccion: $request->direccion);

        return redirect()->route('busqueda_inmuebles', ['operacion' => $url_string]);
    }
}
