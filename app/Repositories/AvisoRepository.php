<?php

namespace App\Repositories;

use App\Models\Aviso;
use Illuminate\Support\Facades\DB;

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
                            // ->whereHas('historial', fn($q) => $q->where('estados_avisos.id', 3))
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
                            ->select('avisos.*')
                            ->addSelect(DB::raw("(select estado_aviso_id from historial_avisos where aviso_id = avisos.id order by historial_avisos.id desc limit 1) AS estado_aviso"))
                            ->orderByDesc(DB::raw('(SELECT MAX(id) FROM historial_avisos WHERE aviso_id = avisos.id)'))
                            ->limit(15)
                            ->get();
    }

    public function getInmueble(int $id)
    {
        return $this->model->where('estado', 1)
                    ->where('id', $id)
                    ->whereHas('inmueble', fn($q) => $q->where('estado', 1))
                    ->select()
                    ->addSelect(DB::raw("(select estado_aviso_id from historial_avisos where aviso_id = avisos.id order by historial_avisos.id desc limit 1) AS estado_aviso"))
                    ->first();
    }

    public function getByFilter($slug, $request)
    {
        $query = $this->model->where('estado', 1)
                    // ->whereHas('historial', fn($q) => $q->where('estados_avisos.id', 3))
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
                    ->select()
                    ->addSelect(DB::raw("(select estado_aviso_id from historial_avisos where aviso_id = avisos.id order by historial_avisos.id desc limit 1) AS estado_aviso"))
                    ->paginate(10);
    }
}
