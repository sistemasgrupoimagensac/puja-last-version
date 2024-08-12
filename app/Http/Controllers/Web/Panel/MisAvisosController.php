<?php

namespace App\Http\Controllers\Web\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Aviso;

class MisAvisosController extends Controller
{
    public function __construct()
    {        
    }

    public function __invoke(Request $request)
    {
        $avisos = Aviso::where('estado', 1)
                    ->whereHas('inmueble', function($q) {
                        $q->where('estado', 1)->where('user_id', Auth::user()->id);
                    })
        ->get();
        $tienePlanes = false;
        
        if (Auth::check()) {
            $user_id = Auth::id();
            $user = User::find($user_id);
            $active_plan_users = $user->active_plans()->get();
            $tienePlanes = $active_plan_users->isNotEmpty();
        }

        return view('panel.mis-avisos', compact('avisos', 'tienePlanes'));
    }
}
