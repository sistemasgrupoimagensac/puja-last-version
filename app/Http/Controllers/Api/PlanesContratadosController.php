<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class PlanesContratadosController extends Controller
{
    public function getUserPlans($userId)
    {
        $user = User::find($userId);

        $user_type = $user->tipo_usuario_id;
        $plans = $user->active_plans()->get();
        $hasPlans = false;
        $projectInfo = false;
        
        $hasPlans = $user->active_plans()->exists();
        $projectInfo = $user->canPublishProjects();

        return response()->json([
            'message' => 'Planes por usuario.',
            'status' => 'success',
            'user_type' => $user_type,
            'plans' => $plans,
            'hasPlans' => $hasPlans,
            'projectInfo' => $projectInfo,
        ]);

    }
}
