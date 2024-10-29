<?php

namespace App\Http\Controllers\Web\Puja;

use App\Repositories\AvisoRepository;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Services\Aviso\ObtenerAviso;
use Illuminate\Http\Request;
use App\Models\User;


class InmuebleController extends Controller
{
    public function __construct(protected AvisoRepository $repository)
    {        
    }

    public function __invoke(Request $request, $inmueble)
    {
        try {
            $aviso = (new ObtenerAviso($this->repository))->__invoke($inmueble);
            $user_login_id = 0;
            $tipo_usuario = 0;
            $user_not_pay = false;
            $plan_id = 117;
            if ( $plan_id === 117 ) $tipo_aviso = 3;
            if ( Auth::check() ) {
                $user_login_id = Auth::id();
                $user = Auth::user();
                $tipo_usuario = $user->tipo_usuario_id;
                if ( $tipo_usuario === 4 && $user->not_pay === 1 ) $user_not_pay = true;

            }
            $ad_user_id = $aviso->inmueble->user_id;
            $publicado = $aviso->historial[0]->estado == "Publicado" ? true : false;
            $ad_belongs = false;
            if ( (int)$user_login_id === (int)$ad_user_id ) {
                $ad_belongs = true;
            } else {
                $aviso->views++;
                $aviso->save();
            }

            $tienePlanes = null;
            $projectInfo = false;
            if (Auth::check()) {
                $user_id = Auth::id();
                $user = User::find($user_id);
                $active_plan_users = $user->active_plans()->get();
                $tienePlanes = $active_plan_users->isNotEmpty();
                $projectInfo = $user->canPublishProjects(); 
            }
            
            return view('inmueble', compact('aviso', 'ad_belongs', 'publicado', 'tipo_usuario', 'tienePlanes', 'user_not_pay', 'plan_id', 'tipo_aviso', 'projectInfo'));

        } catch (\Throwable $th) {
            return response()->json([
                'http_code' => 500,
                'message' => 'Error al mostrar el aviso.',
                'error' => $th->getMessage() // Mensaje de error detallado
            ], 500); // Código de estado HTTP 500 (Internal Server Error)
        }
    }
}
