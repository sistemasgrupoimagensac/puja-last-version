<?php

namespace App\Http\Controllers\Web\Puja;

use App\Http\Controllers\Controller;
use App\Repositories\AvisoRepository;
use App\Services\Aviso\FiltrarAvisos;
use Illuminate\Http\Request;

class InmueblesController extends Controller
{
    public function __construct(protected AvisoRepository $repository)
    {        
    }

    public function __invoke(Request $request)
    {
        $avisos = (new FiltrarAvisos($this->repository))->__invoke($request);
        return view('inmuebles', compact('avisos'));
    }
}
