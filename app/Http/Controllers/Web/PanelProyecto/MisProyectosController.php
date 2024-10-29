<?php

namespace App\Http\Controllers\Web\PanelProyecto;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Proyecto;  // Modelo de proyectos
use App\Models\User;

class MisProyectosController extends Controller
{
    public function __construct()
    {
        // Constructor vacío, puedes agregar servicios o repositorios si es necesario
    }

    public function __invoke(Request $request)
    {
        // Verificar que el usuario esté autenticado
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        // Obtener el usuario autenticado
        $user_id = Auth::id();
        $user = User::find($user_id);

        $proyectos = Proyecto::whereHas('cliente', function($query) use ($user) {
            $query->where('user_id', $user->id);  // Asociado al proyecto_cliente del usuario autenticado
        })
        ->with(['imagenesAdicionales' => function ($query) {
            $query->where('estado', 1);  // Filtrar las imágenes activas
        }])
        ->orderBy('id', 'desc') // Ordenar los proyectos por ID descendente
        ->paginate(10); // Paginación de 10 proyectos

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

        // Renderizar la vista 'panel.mis-proyectos' y pasar los datos necesarios
        return view('panel.mis-proyectos', compact('proyectos', 'tienePlanes', 'projectInfo'));
    }
}
