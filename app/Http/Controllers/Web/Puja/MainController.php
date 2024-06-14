<?php

namespace App\Http\Controllers\Web\Puja;

use App\Http\Controllers\Controller;
use App\Repositories\AvisoRepository;
use App\Services\Aviso\ObtenerAvisosPrincipales;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function __construct(protected AvisoRepository $repository)
    {        
    }

    public function __invoke(Request $request)
    {
        $avisos = (new ObtenerAvisosPrincipales($this->repository))->__invoke();
        return view('home', compact('avisos'));
    }
}
