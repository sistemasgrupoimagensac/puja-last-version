<?php

namespace App\Services\Proyectos;

use Carbon\Carbon;
use App\Models\ProyectoCliente;
use Illuminate\Support\Facades\Log;

class ServicioVigenciaProyecto
{
    public function actualizarVigencia(): void
    {
        $hoy = now();
    
        ProyectoCliente::query()
            ->whereNotNull('fecha_inicio_contrato')
            ->whereNotNull('fecha_fin_contrato')
            ->get()
            ->each(function ($cliente) use ($hoy) {
                $vigente = $cliente->fecha_inicio_contrato <= $hoy && $cliente->fecha_fin_contrato >= $hoy;
                $cliente->update(['vigente' => $vigente]);
            });
    }
    
}