<?php

namespace App\Services\Aviso;

use App\Repositories\AvisoRepository;

class ObtenerAviso
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected AvisoRepository $repository)
    {
    }

    public function __invoke(int $id)
    {
        return $this->repository->getInmueble($id);
    }
}
