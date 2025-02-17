<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Proyecto;
use App\Models\ProyectoImagenesAdicionales;
use App\Models\TipoOperacion;
use App\Repositories\AvisoRepository;
use App\Repositories\TipoInmuebleRepository;
use App\Services\Aviso\ObtenerAvisosPrincipales;
use App\Services\TipoInmueble\ObtenerTiposInmuebles;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function __construct(
        protected AvisoRepository $repository_aviso,
        protected TipoInmuebleRepository $repository_tipoinmueble)
    {        
    }

    public function __invoke()
    {
        $avisos = (new ObtenerAvisosPrincipales($this->repository_aviso))->__invoke();

        $ads = $avisos->map(function ($aviso) {
            $avisoArray = $aviso->toArray();
        
            $avisoArray['estado_aviso_id'] = $aviso->historial->first()->pivot->estado_aviso_id;
            $avisoArray['codigo_unico'] = $aviso->inmueble->codigo_unico;
            $avisoArray['link'] = $aviso->link();
            $avisoArray['tituloReal'] = $aviso->inmueble->tituloReal();
            $avisoArray['imagenPrincipal'] = $aviso->inmueble->imagenPrincipal();
            $avisoArray['type'] = $aviso->inmueble->type();
            $avisoArray['category'] = $aviso->inmueble->category();
            $avisoArray['currencySoles'] = $aviso->inmueble->currencySoles();
            $avisoArray['currencyDolares'] = $aviso->inmueble->currencyDolares();
            $avisoArray['precioSoles'] = $aviso->inmueble->precioSoles();
            $avisoArray['precioDolares'] = $aviso->inmueble->precioDolares();
            $avisoArray['remate_precio_base'] = $aviso->inmueble->remate_precio_base();
            $avisoArray['remate_valor_tasacion'] = $aviso->inmueble->remate_valor_tasacion();
            $avisoArray['address'] = $aviso->inmueble->address();
            $avisoArray['distrito'] = $aviso->inmueble->distrito();
            $avisoArray['provincia'] = $aviso->inmueble->provincia();
            $avisoArray['departamento'] = $aviso->inmueble->departamento();
            $avisoArray['estado'] = $aviso->historial[0]->estado;
            $avisoArray['fecha_publicacion'] = $aviso->fecha_publicacion;
            $avisoArray['title'] = $aviso->inmueble->title();
            $avisoArray['area'] = $aviso->inmueble->area();
            $avisoArray['dormitorios'] = $aviso->inmueble->dormitorios();
            $avisoArray['banios'] = $aviso->inmueble->banios();
            $avisoArray['comodidades'] = $aviso->inmueble->extra->caracteristicas->where('categoria_caracteristica_id', 2);
        
            return $avisoArray;
        });

        $proyectoImgs = ProyectoImagenesAdicionales::where('tipo', 1)->inRandomOrder()->first();
        $proyectoImg = $proyectoImgs ? Proyecto::where('id', $proyectoImgs->proyecto_id)->first() : null;
        
        return response()->json([
            'message' => 'Datos de inicio',
            'status' => 'success',
            'avisos' => $ads,
            'avisos_nuevos' => $ads->take(8),
            'proyectoImgs' => $proyectoImgs,
            'proyectoImg' => $proyectoImg,
        ]);
    }
    
    public function tiposInmuebles()
    {
        $tipos_inmuebles = (new ObtenerTiposInmuebles($this->repository_tipoinmueble))->__invoke();

        return response()->json([
            'message' => 'Tipos de inmuebles.',
            'status' => 'success',
            'tipos_inmuebles' => $tipos_inmuebles,
        ]);
    }
    
    public function tiposOperacion()
    {
        $tipo_operacion = TipoOperacion::get();

        return response()->json([
            'message' => 'Tipos de inmuebles.',
            'status' => 'success',
            'tipo_operacion' => $tipo_operacion,
        ]);
    }
}
