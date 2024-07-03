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
            $user_type = Auth::user()->tipo_usuario_id;
            return view('inmueble', compact('aviso', 'user_type'));
        } catch (\Exception $e) {
            abort($e->getCode());
        }
    }
}
