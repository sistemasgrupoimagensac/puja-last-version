<?php

namespace App\Services\Aviso;

use App\Repositories\AvisoRepository;

class ObtenerAvisosPrincipales
{
    public function __construct(protected AvisoRepository $repository)
    {
    }

    public function __invoke()
    {
        return $this->repository->getPrincipales();
    }
}
