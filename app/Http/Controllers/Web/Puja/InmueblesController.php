<?php

namespace App\Http\Controllers\Web\Puja;

use App\Http\Controllers\Controller;
use App\Repositories\AvisoRepository;
use App\Repositories\TipoInmuebleRepository;
use App\Repositories\TipoOperacionRepository;
use App\Services\Aviso\FiltrarAvisos;
use App\Services\Url\ParsearUrl;
use App\Services\TipoInmueble\ObtenerTiposInmuebles;
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

    public function busquedaInmuebles(Request $request, $operacion)
    {
        $url_parse = (new ParsearUrl($this->tipo_inmueble_repository, $this->tipo_operacion_repository))->forFilter($operacion);
        $tipos_inmuebles = (new ObtenerTiposInmuebles($this->tipo_inmueble_repository))->__invoke();
        $avisos = (new FiltrarAvisos($this->repository))->__invoke($url_parse, $request);
        return view('inmuebles', compact('avisos', 'url_parse', 'tipos_inmuebles'));
    }

    public function filterSearch(Request $request)
    {
        $url_string = (new ParsearUrl($this->tipo_inmueble_repository, $this->tipo_operacion_repository))->makeUrl(tipo_inmueble: $request->categoria, tipo_operacion: $request->transaccion, direccion: $request->direccion);

        return redirect()->route('busqueda_inmuebles', ['operacion' => $url_string]);
    }
}
