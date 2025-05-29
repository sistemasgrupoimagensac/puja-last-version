<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Aviso;
use App\Models\Caracteristica;
use App\Models\User;
use App\Repositories\AvisoRepository;
use App\Repositories\TipoInmuebleRepository;
use App\Repositories\TipoOperacionRepository;
use App\Services\Aviso\FiltrarAvisos;
use App\Services\TipoInmueble\ObtenerTiposInmuebles;
use App\Services\Url\ParsearUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        $ads = $avisos->map(function ($aviso) {
            $avisoArray = $aviso->toArray();

            $avisoArray['estado_aviso_id'] = $aviso->historial()->orderByDesc('historial_avisos.id')->first()->id;
            $avisoArray['codigo_unico'] = $aviso->inmueble->codigo_unico;
            $avisoArray['link'] = $aviso->link();
            $avisoArray['nombres'] = $aviso->inmueble->user->nombres;
            $avisoArray['apellidos'] = $aviso->inmueble->user->apellidos;
            $avisoArray['tituloReal'] = $aviso->inmueble->tituloReal();
            $avisoArray['imagenPrincipal'] = $aviso->inmueble->imagenPrincipal();
            $avisoArray['type'] = $aviso->inmueble->type();
            $avisoArray['category'] = $aviso->inmueble->category();
            $avisoArray['idCaracteristica'] = $aviso->inmueble->idCaracteristica();
            $avisoArray['currencySoles'] = $aviso->inmueble->currencySoles();
            $avisoArray['currencyDolares'] = $aviso->inmueble->currencyDolares();
            $avisoArray['precioSoles'] = $aviso->inmueble->precioSoles();
            $avisoArray['precioDolares'] = $aviso->inmueble->precioDolares();
            $avisoArray['is_puja'] = $aviso->inmueble->is_puja();
            $avisoArray['remate_precio_base'] = $aviso->inmueble->remate_precio_base();
            $avisoArray['remate_valor_tasacion'] = $aviso->inmueble->remate_valor_tasacion();
            $avisoArray['address'] = $aviso->inmueble->address();
            $avisoArray['distrito'] = $aviso->inmueble->distrito();
            $avisoArray['provincia'] = $aviso->inmueble->provincia();
            $avisoArray['departamento'] = $aviso->inmueble->departamento();
            $avisoArray['estado'] = $aviso->historial()->orderByDesc('historial_avisos.id')->first()->estado;
            $avisoArray['fecha_publicacion'] = $aviso->fecha_publicacion;
            $avisoArray['title'] = $aviso->inmueble->title();
            $avisoArray['area'] = $aviso->inmueble->area();
            $avisoArray['dormitorios'] = $aviso->inmueble->dormitorios();
            $avisoArray['banios'] = $aviso->inmueble->banios();
            $avisoArray['description'] = $aviso->inmueble->description();
            $avisoArray['ad_type'] = $aviso->ad_type;
            $avisoArray['views'] = $aviso->views;
            $avisoArray['inmueble_id'] = $aviso->inmueble->id;
            $avisoArray['comodidades'] = $aviso->inmueble->extra->caracteristicas->where('categoria_caracteristica_id', 2)->take(3);

            return $avisoArray;
        });

        return response()->json([
            'message' => 'Filtros.',
            'status' => 'success',
            'avisos' => $ads,
            'url_parse' => $url_parse,
            'tipos_inmuebles' => $tipos_inmuebles,
        ]);
    }

    public function getRemates(Request $request)
    {
        $avisos = Aviso::where('estado', 1)
            ->whereHas('historial', function ($q) {
                $q->whereRaw('
                            historial_avisos.id = (
                                SELECT MAX(h2.id)
                                FROM historial_avisos h2
                                WHERE h2.aviso_id = historial_avisos.aviso_id
                            )
                            AND historial_avisos.estado_aviso_id IN(3, 8)
                        ');
            })
            ->whereHas('inmueble', fn($q) => $q->where('estado', 1))
            ->whereHas('inmueble.principal.operacion', function($q) {
                $q->where('tipo_operacion_id', 3);
            })->orderBy('ad_type', 'desc')
            ->orderBy('fecha_publicacion', 'desc')
            ->select()
            ->addSelect(DB::raw("(select estado_aviso_id from historial_avisos where aviso_id = avisos.id order by historial_avisos.id desc limit 1) AS estado_aviso"))
            ->limit(10)
            ->get();

        $ads = $avisos->map(function ($aviso) {
            $avisoArray = $aviso->toArray();

            $avisoArray['estado_aviso_id'] = $aviso->historial()->orderByDesc('historial_avisos.id')->first()->id;
            $avisoArray['codigo_unico'] = $aviso->inmueble->codigo_unico;
            $avisoArray['link'] = $aviso->link();
            $avisoArray['nombres'] = $aviso->inmueble->user->nombres;
            $avisoArray['apellidos'] = $aviso->inmueble->user->apellidos;
            $avisoArray['tituloReal'] = $aviso->inmueble->tituloReal();
            $avisoArray['imagenPrincipal'] = $aviso->inmueble->imagenPrincipal();
            $avisoArray['type'] = $aviso->inmueble->type();
            $avisoArray['category'] = $aviso->inmueble->category();
            $avisoArray['idCaracteristica'] = $aviso->inmueble->idCaracteristica();
            $avisoArray['currencySoles'] = $aviso->inmueble->currencySoles();
            $avisoArray['currencyDolares'] = $aviso->inmueble->currencyDolares();
            $avisoArray['precioSoles'] = $aviso->inmueble->precioSoles();
            $avisoArray['precioDolares'] = $aviso->inmueble->precioDolares();
            $avisoArray['is_puja'] = $aviso->inmueble->is_puja();
            $avisoArray['remate_precio_base'] = $aviso->inmueble->remate_precio_base();
            $avisoArray['remate_valor_tasacion'] = $aviso->inmueble->remate_valor_tasacion();
            $avisoArray['address'] = $aviso->inmueble->address();
            $avisoArray['distrito'] = $aviso->inmueble->distrito();
            $avisoArray['provincia'] = $aviso->inmueble->provincia();
            $avisoArray['departamento'] = $aviso->inmueble->departamento();
            $avisoArray['estado'] = $aviso->historial()->orderByDesc('historial_avisos.id')->first()->estado;
            $avisoArray['fecha_publicacion'] = $aviso->fecha_publicacion;
            $avisoArray['title'] = $aviso->inmueble->title();
            $avisoArray['area'] = $aviso->inmueble->area();
            $avisoArray['dormitorios'] = $aviso->inmueble->dormitorios();
            $avisoArray['banios'] = $aviso->inmueble->banios();
            $avisoArray['description'] = $aviso->inmueble->description();
            $avisoArray['ad_type'] = $aviso->ad_type;
            $avisoArray['views'] = $aviso->views;
            $avisoArray['inmueble_id'] = $aviso->inmueble->id;
            $avisoArray['comodidades'] = $aviso->inmueble->extra->caracteristicas->where('categoria_caracteristica_id', 2)->take(3);

            return $avisoArray;
        });

        return response()->json([
            'message' => 'Filtros.',
            'status' => 'success',
            'avisos' => $ads,
        ]);
    }

    public function filterSearch(Request $request)
    {
        $request->validate([
            'categoria' => 'required',
            'transaccion' => 'required',
            'direccion' => 'string',
        ]);

        $url_string = (new ParsearUrl($this->tipo_inmueble_repository, $this->tipo_operacion_repository))->makeUrl(tipo_inmueble: $request->categoria, tipo_operacion: $request->transaccion, direccion: $request->direccion);

        return response()->json([
            'message' => 'Búsqueda filtrada.',
            'status' => 'success',
            'operation' => $url_string,
        ]);
    }

    public function getCaracteristicas(Request $request)
    {
        $caracteristicas = Caracteristica::where('categoria_caracteristica_id', 1)->get();

        return response()->json([
            'message' => 'Características.',
            'status' => 'success',
            'caracteristicas' => $caracteristicas,
        ]);
    }

    public function getComodidades(Request $request)
    {
        $comodidades = Caracteristica::where('categoria_caracteristica_id', 2)->get();

        return response()->json([
            'message' => 'Comodidades.',
            'status' => 'success',
            'comodidades' => $comodidades,
        ]);
    }
}
