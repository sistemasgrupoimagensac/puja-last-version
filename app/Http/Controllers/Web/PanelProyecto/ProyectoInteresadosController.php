<?php

namespace App\Http\Controllers\Web\PanelProyecto;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ProyectoContact; // Importamos el modelo correspondiente a la tabla de contactos
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProyectoInteresadosController extends Controller
{
    public function __invoke(Request $request)
    {
        $tienePlanes = false;
        $projectInfo = false;
        $interesados = [];

        if (Auth::check()) {
            $user_id = Auth::id();
            $user = User::find($user_id);
            $tipo_usuario = $user->tipo_usuario_id;

            // Obtener los contactos asociados al usuario autenticado
            $interesados = ProyectoContact::where('user_id', $user_id)->get();

            // Obtener los planes activos y la información del proyecto
            $active_plan_users = $user->active_plans()->get();
            $tienePlanes = $active_plan_users->isNotEmpty();
            $projectInfo = $user->canPublishProjects();
        }

        return view('panel.proyecto-interesados', compact('tienePlanes', 'projectInfo', 'interesados'));
    }

    public function updateStatus(Request $request)
    {
        $contactId = $request->input('id');
        $status = $request->input('status');

        // Buscar el contacto
        $contact = ProyectoContact::find($contactId);

        if (!$contact) {
            return response()->json(['message' => 'Contacto no encontrado'], 404);
        }

        // Actualizar el estado
        $contact->status = $status;
        $contact->save();

        return response()->json(['message' => 'Estado actualizado correctamente']);
    }

}
