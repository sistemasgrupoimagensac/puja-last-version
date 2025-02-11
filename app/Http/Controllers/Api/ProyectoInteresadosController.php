<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProyectoContact;
use App\Models\User;
use Illuminate\Http\Request;

class ProyectoInteresadosController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate(['user_id' => 'required|integer']);
        $user = User::with('tipoUsuario')->findOrFail($request->user_id);
        $interesados = ProyectoContact::where('user_id', $request->user_id)->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Interesados',
            'interesados' => $interesados,
        ]);

       /*  $tienePlanes = false;
        $projectInfo = false;
        $interesados = [];


            $active_plan_users = $user->active_plans()->get();
            $tienePlanes = $active_plan_users->isNotEmpty();
            $projectInfo = $user->canPublishProjects();

        return view('panel.proyecto-interesados', compact('tienePlanes', 'projectInfo', 'interesados')); */
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
