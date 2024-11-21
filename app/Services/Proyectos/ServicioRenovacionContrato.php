<?php

namespace App\Services\Proyectos;

use App\Models\ProyectoPlanesActivos;
use Carbon\Carbon;

class ServicioRenovacionContrato
{
    public function renovarContrato(ProyectoPlanesActivos $plan)
    {
        // Validar que el plan es elegible para renovación
        if (!$plan->renovacion_automatica || $plan->estado !== 'activo') {
            return false; // No se puede renovar
        }

        $nuevaFechaInicio = Carbon::parse($plan->fecha_fin)->addDay();
        $nuevaFechaFin = $nuevaFechaInicio->copy()->addMonths($plan->duracion);

        // Crear nuevo plan renovado
        $nuevoPlan = ProyectoPlanesActivos::create([
            'proyecto_cliente_id' => $plan->proyecto_cliente_id,
            'fecha_inicio' => $nuevaFechaInicio,
            'fecha_fin' => $nuevaFechaFin,
            'monto' => $plan->monto,
            'duracion' => $plan->duracion,
            'renovacion_automatica' => $plan->renovacion_automatica,
            'estado' => 'activo',
        ]);

        // Actualizar el estado del plan anterior
        $plan->update(['estado' => 'renovado']);

        return $nuevoPlan;
    }
}