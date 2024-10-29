<?php

namespace App\Repositories;

use App\Models\Aviso;

class AvisoRepository
{
    protected Aviso $model;
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        $this->model = app()->make(Aviso::class);
    }

    public function getPrincipales()
    {
        return $this->model->where('estado', 1)
                            ->whereHas('inmueble', fn($q) => $q->where('estado', 1))
                            ->whereHas('historial', fn($q) => $q->where('estados_avisos.id', 3))
                            ->get();
    }

    public function getInmueble(int $id)
    {
        return $this->model->where('estado', 1)
                    ->where('id', $id)
                    ->whereHas('inmueble', fn($q) => $q->where('estado', 1))
                    ->first();
    }

    public function getByFilter($slug, $request)
    {
        $query = $this->model->where('estado', 1)
                    ->whereHas('historial', fn($q) => $q->where('estados_avisos.id', 3))
                    ->whereHas('inmueble', fn($q) => $q->where('estado', 1))
                    ->whereHas('inmueble.principal.operacion', function($q) use($slug){
                        if ($slug['operacion'] != null) {
                            $q->where('tipo_operacion_id', ($slug['operacion'])->id);
                        }

                        if ($slug['tipo_inmueble'] != null) {
                            $q->where('tipo_inmueble_id', ($slug['tipo_inmueble'])->id);
                        }
                    })
                    ->whereHas('inmueble.principal.ubicacion', function($q) use($slug) {
                        if ($slug['direccion'] != null) {
                            $q->where('direccion', 'like', '%'.$slug['direccion'].'%')
                                ->orWhereHas('departamento', fn($q) => $q->where('nombre', 'like', '%'.$slug['direccion'].'%'))
                                ->orWhereHas('provincia', fn($q) => $q->where('nombre', 'like', '%'.$slug['direccion'].'%'))
                                ->orWhereHas('distrito', fn($q) => $q->where('nombre', 'like', '%'.$slug['direccion'].'%'));
                        }
                    })
                    ->whereHas('inmueble.principal.caracteristicas', function($q) use($request) {
                        if ($request->preciominimo != null && $request->preciomaximo != null) {
                            $q->whereBetween('precio_soles', [$request->preciominimo, $request->preciomaximo]);
                        }
                        if ($request->dormitorios != null) {
                            $q->where('habitaciones', '>=', $request->dormitorios);
                        }
                        if ($request->banios != null) {
                            $q->where('banios', '>=', $request->banios);
                        }
                        if ($request->areaMinima != null && $request->areaMaxima != null) {
                            $q->whereBetween('area_total', [$request->areaMinima, $request->areaMaxima]);
                        }
                        if ($request->antiguedad != null) {
                            if ($request->antiguedad > 1) {
                                $q->where('anios_antiguedad', '<=', $request->antiguedad);
                            } else {
                                $q->where('antiguedad', '=', $request->antiguedad);
                            }
                        }
                        if ($request->estacionamientos != null) {
                            $q->where('estacionamientos', '>=', $request->estacionamientos);
                        }
                        if ($request->direccionRemate != null) {
                            if ( $request->direccionRemate == 1 || $request->direccionRemate == 2 || $request->direccionRemate == 3 || $request->direccionRemate == 4 ) {
                                $q->where('remate_direccion_id', $request->direccionRemate);
                            }
                        }
                    });

        if ($request->caracteristicas != null) {
            $query->whereHas('inmueble.extra.caracteristicas', function($q) use($request) {
                $idsCaracteristica = explode(',', $request->caracteristicas);
                $q->whereIn('caracteristicas_extra.id', $idsCaracteristica);
            });
        }
        
        return $query->orderBy('ad_type', 'desc')
                    ->orderBy('fecha_publicacion', 'desc')
                    ->paginate(10);
    }
}
