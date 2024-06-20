<?php

namespace App\Services\Aviso;

use App\Repositories\AvisoRepository;
use App\Services\Url\ParsearUrl;
use Illuminate\Http\Request;

class FiltrarAvisos
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected AvisoRepository $repository)
    {
    }

    public function __invoke(array $slug, Request $request)
    {
        $avisos = $this->repository->getByfilter($slug, $request);

        return $avisos;
    }
}
