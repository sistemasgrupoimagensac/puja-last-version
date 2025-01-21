<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TipoDocumento;
use App\Models\User;
use Illuminate\Http\Request;

class PerfilController extends Controller
{
    public function profile(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
        ]);

        $user = User::findOrFail($request->user_id);
        $document_types = TipoDocumento::where('estado', 1)->get();
        $hasPlans = false;
        $projectInfo = false;
        
        $hasPlans = $user->active_plans()->exists();
        $projectInfo = $user->canPublishProjects(); 
        
        return response()->json([
            'message' => 'Perfil de usuario.',
            'status' => 'success',
            'document_types' => $document_types,
            'user' => $user,
            'hasPlans' => $hasPlans,
            'projectInfo' => $projectInfo,
        ]);
    }
}
