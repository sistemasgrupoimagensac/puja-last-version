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
        ->whereHas('planesActivos', function ($query) {
            $query->where('activo', 1); // Filtrar solo aquellos proyectos cuyo cliente esté activo
        })
        ->paginate(9); // Paginación para los proyectos

        return $this->renderView($proyectos);
    }

    public function filtrarProyectos($filtro)
    {
        // Definir los estados de progreso según el filtro
        $progresoMap = [
            'en-planos' => 1,
            'en-construccion' => 2,
            'entrega-inmediata' => 3,
        ];

        // Verificar si el filtro es válido
        if (!array_key_exists($filtro, $progresoMap)) {
            abort(404); // Si el filtro no es válido, mostrar un error 404
        }

        // Obtener los proyectos según el estado de progreso
        $proyectos = Proyecto::with(['banco', 'progreso', 'imagenesAdicionales' => function ($query) {
            $query->where('tipo', 1); // Obtener la imagen con el menor ID
        }])
        ->where('proyecto_progreso_id', $progresoMap[$filtro])
        ->whereHas('cliente', function ($query) {
            $query->where('activo', 1); // Filtrar solo proyectos cuyo cliente esté activo
        })
        ->paginate(9);

        return $this->renderView($proyectos);
    }

    private function renderView($proyectos)
    {
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
