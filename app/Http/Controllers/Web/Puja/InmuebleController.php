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
        $id_slug = $this->getIdSlug($inmueble);
        
        $aviso = (new ObtenerAviso($this->repository))->__invoke($id_slug);

        if (null == $aviso) {
            abort(404);
        }

        return view('inmueble', compact('aviso'));
    }

    public function getIdSlug(string $slug): int
    {
        $url_parts = explode('-', $slug);
        $id = end($url_parts);
        if (!is_numeric($id)) {
            abort(404);
        }

        return (int) $id;
    }
}
