<?php

namespace App\Services\TipoInmueble;

use App\Repositories\TipoInmuebleRepository;

class ObtenerTiposInmuebles
{
    public function __construct(protected TipoInmuebleRepository $repository)
    {
    }

    public function __invoke()
    {
        return $this->repository->getAll();
    }
}
