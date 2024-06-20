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
        return $this->model->where('estado', 1)
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
                        ->get();
    }
}
