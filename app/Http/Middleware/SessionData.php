<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Empresa;
use Symfony\Component\HttpFoundation\Response;

class SessionData
{
    public function handle(Request $request, Closure $next)
    {
        try {
            // $idCompany = $request->header('idCompany');
            $empresa = Empresa::where('id', 1)->first();

            \Session::put('datos_empresa', $empresa);
            \Session::put('datos_fact_elect', $empresa->electronicBilling);

            return $next($request);
            
        } catch (\Throwable $th) {
            return response()->json([
                'http_code' => 500,
                'message' => 'Error al en el middleware',
                'error' => $th->getMessage() // Mensaje de error detallado
            ], 500); // Código de estado HTTP 500 (Internal Server Error)
        }
        
    }
}
