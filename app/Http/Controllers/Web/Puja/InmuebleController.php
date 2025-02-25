<?php

namespace App\Http\Controllers\Web\Puja;

use App\Repositories\AvisoRepository;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Services\Aviso\ObtenerAviso;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;

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
                if ( $tipo_usuario === 3 && $user->not_pay === 1 ) $user_not_pay = true;

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

            $fecha_publicacion =  Carbon::parse($aviso->historial[0]->created_at);
            $fecha_actual = Carbon::today();
            $views = 0;

            $cant_first = 1400;
            $cant_second = 2400;
            if ( $aviso->inmueble->type() == "Remate" ) {
                $cant_first = 90;
                $cant_second = 120;
            }

            if ( $fecha_publicacion->equalTo($fecha_actual) ) {
                $views = ceil($aviso->views * 1.07);
            } elseif ( $fecha_publicacion->equalTo($fecha_actual->copy()->subDay()) ) {
                $views = $cant_first + ceil($aviso->views * 1.07);
            } elseif ( $fecha_publicacion->lessThanOrEqualTo($fecha_actual->copy()->subDays(2)) ) {
                $views = $cant_second + ceil($aviso->views * 1.07);
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
            
            return view('inmueble', compact('aviso', 'ad_belongs', 'publicado', 'tipo_usuario', 'tienePlanes', 'user_not_pay', 'plan_id', 'tipo_aviso', 'projectInfo', 'views'));

        } catch (\Throwable $th) {
            return response()->json([
                'http_code' => 500,
                'message' => 'Error al mostrar el aviso.',
                'error' => $th->getMessage() // Mensaje de error detallado
            ], 500); // Código de estado HTTP 500 (Internal Server Error)
        }
    }
}
