<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserProjectSubscription;
use App\Models\ProyectoCliente;
use App\Models\ProjectPlan;

class UserProjectSubscriptionController extends Controller
{
    public function suscribirPlan(Request $request)
    {
        $request->validate([
            'proyecto_cliente_id' => 'required|integer',
            'customer_id' => 'required|string',
            'card_id' => 'required|string',
            'periodo_plan' => 'required|integer', // Asegúrate de recibir el periodo del plan
        ]);
    
        $proyectoCliente = ProyectoCliente::find($request->proyecto_cliente_id);
    
        if (!$proyectoCliente) {
            return response()->json(['message' => 'ProyectoCliente no encontrado.'], 404);
        }
    
        $userId = $proyectoCliente->user_id;
    
        // Buscar el ID del plan en la tabla project_plans basado en el periodo del plan
        $plan = ProjectPlan::where('duration_in_months', $request->periodo_plan)->first();
    
        if (!$plan) {
            return response()->json(['message' => 'Plan de proyecto no encontrado.'], 404);
        }
    
        UserProjectSubscription::create([
            'user_id' => $userId,
            'project_plan_id' => $plan->id, // Usa la ID del plan encontrado
            'customer_id' => $request->customer_id,
            'card_id' => $request->card_id,
            'start_date' => $proyectoCliente->fecha_inicio_contrato,
            'end_date' => $proyectoCliente->fecha_fin_contrato,
            'status' => true,
        ]);
    
        return response()->json(['message' => 'Plan asociado exitosamente.'], 201);
    }
    
}
