<?php

namespace App\Services\Aviso;

use App\Repositories\AvisoRepository;
use App\Services\Url\ParsearUrl;

class ObtenerAviso
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected AvisoRepository $repository)
    {
    }

    public function __invoke($inmueble)
    {
        $id_slug = ParsearUrl::forSingle($inmueble);

        $aviso = $this->repository->getInmueble($id_slug);

        if (null == $aviso) {
            throw new \Exception("No existe el aviso", 404);
        }

        return $aviso;
    }
}
