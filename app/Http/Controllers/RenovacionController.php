<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ProyectoPlanesActivos;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RenovacionController extends Controller
{
    // Activar o desactivar la renovación automática
    public function toggleRenovacion(Request $request)
    {
        // $plan = ProyectoPlanesActivos::where('proyecto_cliente_id', auth()->user()->proyecto_cliente->id)->first();

        // Validar que venga el proyecto_cliente_id
        $request->validate([
            'proyecto_cliente_id' => 'required|exists:proyecto_planes_activos,proyecto_cliente_id',
        ]);

        // Obtener el plan activo
        $plan = ProyectoPlanesActivos::where('proyecto_cliente_id', $request->proyecto_cliente_id)->first();

        if (!$plan) {
            return response()->json([
                'status' => 'error',
                'message' => 'No se encontró el plan activo.',
            ], 404);
        }

        // Verificar elegibilidad para modificar renovación
        if (!$this->checkElegibilidad($plan)) {
            return response()->json([
                'status' => 'error',
                'message' => 'No puedes modificar la renovación automática fuera del período permitido.',
            ], 403);
        }

        // Alternar renovación automática
        $plan->update([
            'renovacion_automatica' => !$plan->renovacion_automatica,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => $plan->renovacion_automatica
                ? 'Renovación automática habilitada.'
                : 'Renovación automática deshabilitada.',
        ]);
    }

    // Verificar si el usuario puede modificar la renovación automática
    private function checkElegibilidad(ProyectoPlanesActivos $plan): bool
    {
        $fechaLimite = Carbon::parse($plan->fecha_fin)->subDays(30);
        return Carbon::now()->lessThanOrEqualTo($fechaLimite);
    }
}