<?php

namespace App\Http\Controllers\Web\Puja;

use App\Http\Controllers\Controller;
use App\Repositories\AvisoRepository;
use App\Services\Aviso\ObtenerAviso;
use Illuminate\Http\Request;

class InmuebleController extends Controller
{
    public function __construct(protected AvisoRepository $repository)
    {        
    }

    public function __invoke(Request $request, $inmueble)
    {
        try {
            $aviso = (new ObtenerAviso($this->repository))->__invoke($inmueble);
            return view('inmueble', compact('aviso'));
        } catch (\Exception $e) {
            abort($e->getCode());
        }
    }
}
