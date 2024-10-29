<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserProjectType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Verificar si el usuario está autenticado
        if (Auth::check()) {
            // Obtener el tipo de usuario
            $user = Auth::user();
            
            // Verificar si el tipo de usuario es 5 (proyecto/inmobiliaria)
            if ($user->tipo_usuario_id == 5) {
                return $next($request);
            }
        }

        // Si el usuario no está autenticado o no tiene el tipo correcto, redirigir
        return redirect()->route('home')->with('error', 'No tienes permiso para acceder a esta sección.');
    }
}