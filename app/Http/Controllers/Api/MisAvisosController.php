<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Aviso;
use App\Models\User;
use Illuminate\Http\Request;

class MisAvisosController extends Controller
{
    public function __invoke($userId)
    {
        $ads = 
            Aviso::where('estado', 1)
                ->whereHas('inmueble', function($q, $userId) {
                    $q->where('estado', 1)->where('user_id', $userId);
                })
        ->orderBy('id', 'desc');

        return response()->json([
            'message' => 'Avisos por usuario',
            'status' => 'success',
            'ads' => $ads,
        ]);

        $tienePlanes = false;
        $projectInfo = false;

        if ( $userId ) {
            $user = User::findOrFail($userId);
            $tienePlanes = $user->active_plans()->exists();
            $projectInfo = $user->canPublishProjects(); 
        }

        return response()->json([
            'message' => 'Avisos por usuario.',
            'status' => 'success',
            'ads' => $ads,
            'hasPlans' => $tienePlanes,
            'projectInfo' => $projectInfo,
        ]);
    }
}
