<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProyectoPlanesActivos;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RenovacionController extends Controller
{
    public function toggleRenovacion(Request $request)
    {
        $request->validate(['proyecto_cliente_id' => 'required|exists:proyecto_planes_activos,proyecto_cliente_id']);

        $plan = ProyectoPlanesActivos::where('proyecto_cliente_id', $request->proyecto_cliente_id)->first();

        if ( !$plan ) {
            return response()->json([
                'status' => 'error',
                'message' => 'No se encontró el plan activo.',
            ], 404);
        }

        if (!$this->checkElegibilidad($plan)) {
            return response()->json([
                'status' => 'error',
                'message' => 'No puedes modificar la renovación automática fuera del período permitido.',
            ], 403);
        }

        $plan->update(['renovacion_automatica' => !$plan->renovacion_automatica]);

        return response()->json([
            'status' => 'success',
            'message' => $plan->renovacion_automatica
                ? 'Renovación automática habilitada.'
                : 'Renovación automática deshabilitada.',
        ]);
    }

    private function checkElegibilidad(ProyectoPlanesActivos $plan): bool
    {
        $fechaLimite = Carbon::parse($plan->fecha_fin)->subDays(30);
        return Carbon::now()->lessThanOrEqualTo($fechaLimite);
    }
}
