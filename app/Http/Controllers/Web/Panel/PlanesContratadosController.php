<?php

namespace App\Http\Controllers\Web\Panel;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PlanesContratadosController extends Controller
{
    public function __construct()
    {
        //
    }

    public function __invoke()
    {
        if ( !Auth::check() ) return redirect()->route('sign_in')->with('error', 'Inicia sesión, por favor.');
        $user_id = Auth::id();
        $user = User::find($user_id);
        $active_plan_users = $user->active_plans()->get();
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

        return view('panel.planes-contratados', compact('active_plan_users', 'tienePlanes', 'tipo_usuario', 'projectInfo'));
    }
}
