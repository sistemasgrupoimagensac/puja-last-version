<?php

namespace App\Http\Controllers\Web\Puja;

use App\Http\Controllers\Controller;
use App\Repositories\AvisoRepository;
use App\Repositories\TipoInmuebleRepository;
use App\Services\Aviso\ObtenerAvisosPrincipales;
use App\Services\TipoInmueble\ObtenerTiposInmuebles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class MainController extends Controller
{
    public function __construct(protected AvisoRepository $repository_aviso, protected TipoInmuebleRepository $repository_tipoinmueble)
    {        
    }

    public function __invoke(Request $request)
    {
        $avisos = (new ObtenerAvisosPrincipales($this->repository_aviso))->__invoke();
        $tipos_inmuebles = (new ObtenerTiposInmuebles($this->repository_tipoinmueble))->__invoke();


        // Inicializar la variable $tienePlanes como false
        $tienePlanes = false;

        // Verificar si el usuario está autenticado
        if (Auth::check()) {
            $user_id = Auth::id();
            $user = User::find($user_id);
            $active_plan_users = $user->active_plans()->get();
            $tienePlanes = $active_plan_users->isNotEmpty();
        }

        return view('home', compact('avisos', 'tipos_inmuebles', 'tienePlanes'));
    }
}
