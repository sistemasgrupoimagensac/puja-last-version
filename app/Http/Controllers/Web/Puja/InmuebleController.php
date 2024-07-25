<?php

namespace App\Http\Controllers\Web\Puja;

use App\Http\Controllers\Controller;
use App\Repositories\AvisoRepository;
use App\Services\Aviso\ObtenerAviso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            if ( Auth::check() ) $user_login_id = Auth::id();
            $ad_user_id = $aviso->inmueble->user_id;
            
            $publicado = $aviso->historial[0]->estado == "Publicado" ? true : false;
            $ad_belongs = false;
            if ( (int)$user_login_id === (int)$ad_user_id ) $ad_belongs = true;
            
            return view('inmueble', compact('aviso', 'ad_belongs', 'publicado'));
        } catch (\Exception $e) {
            abort($e->getCode());
        }
    }
}
