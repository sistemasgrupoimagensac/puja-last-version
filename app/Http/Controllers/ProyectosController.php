<?php

namespace App\Http\Controllers;

use App\Models\Proyecto; // Importar el modelo Proyecto
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProyectosController extends Controller
{
    public function index()
    {
        // Obtener todos los proyectos cuyos clientes estén activos (activo = 1)
        $proyectos = Proyecto::with(['banco', 'progreso', 'imagenesAdicionales' => function ($query) {
            $query->where('tipo', 1); // Obtener la imagen con el menor ID
        }])
        ->whereHas('cliente', function ($query) {
            // Filtrar solo aquellos proyectos cuyo cliente esté activo
            $query->where('activo', 1);
        })
        ->paginate(9); // Paginación para los proyectos

        $tienePlanes = false;
        $projectInfo = false;

        // Verificar si el usuario está autenticado
        if (Auth::check()) {
            $user_id = Auth::id();
            $user = User::find($user_id);
            $tipo_usuario = $user->tipo_usuario_id;
            $active_plan_users = $user->active_plans()->get();
            $tienePlanes = $active_plan_users->isNotEmpty();
            $projectInfo = $user->canPublishProjects(); 
        }

        // Retornar la vista con los proyectos y las imágenes
        return view('proyectos', compact('proyectos', 'tienePlanes', 'projectInfo'));
    }
}
