<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Proyecto;
use App\Models\User;
use Illuminate\Http\Request;

class MisProyectosController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate(['user_id' => 'required|integer']);
        $user = User::find($request->user_id);
    
        $proyectos = Proyecto::whereHas('cliente', function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                })
            ->with(['imagenesAdicionales' => function ($query) {
                    $query->where('estado', 1);
                }])
            ->orderBy('id', 'desc')
        ->get();
    
        foreach ( $proyectos as $proyecto ) {
            $proyecto->selected_image = $proyecto->imagenesAdicionales
                ->filter(fn($imagen) => $imagen->tipo === '1')
                ->first()?->image_url
                    ?? $proyecto->imagenesAdicionales->first()?->image_url
                    ?? null;
        }

        return response()->json([
            'message' => 'Proyectos devueltos.',
            'status' => 'success'
        ]);
    
        /* $tienePlanes = false;
        $projectInfo = false;
        if (Auth::check()) {
            $user_id = Auth::id();
            $user = User::find($user_id);
            $tipo_usuario = $user->tipo_usuario_id;
            $active_plan_users = $user->active_plans()->get();
            $tienePlanes = $active_plan_users->isNotEmpty();
            $projectInfo = $user->canPublishProjects(); s
        }
    
        return view('panel.mis-proyectos', compact('proyectos', 'tienePlanes', 'projectInfo')); */
    }
}
