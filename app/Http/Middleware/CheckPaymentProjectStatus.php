<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\ProyectoCliente;
use App\Models\ProyectoPlanesActivos;
use Illuminate\Support\Facades\Log;

class CheckPaymentProjectStatus
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $proyectoClienteId = session('proyectoClienteId');
        $proyectoPlanActivoId = session('proyectoPlanActivoId');
        
        // Si no hay un ID de proyecto en la sesión, redirigir a 404
        if ( !$proyectoClienteId || !$proyectoPlanActivoId ) {
            return response()->view('errors.404', [], 404);
        }

        // Obtener el proyecto del cliente y verificar si ya está pagado
        $proyectoCliente = ProyectoCliente::find($proyectoClienteId);
        $proyectoPlanActivo = ProyectoPlanesActivos::find($proyectoPlanActivoId);

        if ( !$proyectoPlanActivo || $proyectoPlanActivo->pagado ) {
            return response()->view('errors.404', [], 404); // Redirigir a 404 si ya está pagado
        }

        // Procesar la solicitud y añadir encabezados para evitar caché
        $response = $next($request);

        return $response->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
                        ->header('Pragma', 'no-cache')
                        ->header('Expires', 'Sat, 01 Jan 2000 00:00:00 GMT');
    }
}
