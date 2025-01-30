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
        $proyectos = Proyecto::with(['banco', 'progreso', 'imagenesAdicionales' => function ($query) {
                $query->where('tipo', 1);
            }])
            ->whereHas('planesActivos', function ($query) {
                $query->where('activo', 1);
            })
        ->paginate(9);

        return $this->renderView($proyectos);
    }

    public function filtrarProyectos($filtro)
    {
        $progresoMap = [
            'en-planos'         => 1,
            'en-construccion'   => 2,
            'entrega-inmediata' => 3,
        ];

        if ( !array_key_exists($filtro, $progresoMap) ) {
            abort(404);
        }

        $proyectos = Proyecto::with(['banco', 'progreso', 'imagenesAdicionales' => function ($query) {
                $query->where('tipo', 1);
            }])
            ->where('proyecto_progreso_id', $progresoMap[$filtro])
            ->whereHas('planesActivos', function ($query) {
                $query->where('activo', 1);
            })
        ->paginate(9);

        return $this->renderView($proyectos);
    }

    private function renderView($proyectos)
    {
        $tienePlanes = false;
        $projectInfo = false;

        if (Auth::check()) {
            $user_id = Auth::id();
            $user = User::find($user_id);
            $tipo_usuario = $user->tipo_usuario_id;
            $active_plan_users = $user->active_plans()->get();
            $tienePlanes = $active_plan_users->isNotEmpty();
            $projectInfo = $user->canPublishProjects(); 
        }

        return view('proyectos', compact('proyectos', 'tienePlanes', 'projectInfo'));
    }
    
}
