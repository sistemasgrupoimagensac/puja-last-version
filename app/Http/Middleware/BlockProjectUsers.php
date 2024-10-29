<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlockProjectUsers
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Si el usuario está autenticado y es del tipo proyecto (tipo_usuario_id = 5)
        if (Auth::check() && Auth::user()->tipo_usuario_id === 5) {
            // Redirigir al panel de proyecto
            return redirect()->route('panel.proyecto.mis-proyectos');
        }

        // Si no es tipo proyecto, permitir el acceso al panel general
        return $next($request);
    }
}
