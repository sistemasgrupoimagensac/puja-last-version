<?php

namespace App\Http\Controllers\Web\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\TipoDocumento;
use Illuminate\Http\Request;
use App\Models\User;


class PerfilController extends Controller
{
    public function __construct()
    {
    }

    public function __invoke(Request $request)
    {
        $user = Auth::user();
        $tipos_documento = TipoDocumento::where('estado', 1)->get();
        $tienePlanes = false;
        $projectInfo = false;
        
        if (Auth::check()) {
            $user_id = Auth::id();
            $user = User::find($user_id);
            $active_plan_users = $user->active_plans()->get();
            $tienePlanes = $active_plan_users->isNotEmpty();
            $projectInfo = $user->canPublishProjects(); 
        }
        
        return view('panel.perfil', compact('user', 'tipos_documento', 'tienePlanes', 'projectInfo'));
    }
}
