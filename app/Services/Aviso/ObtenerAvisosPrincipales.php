<?php

namespace App\Services\Aviso;

use App\Repositories\AvisoRepository;

class ObtenerAvisosPrincipales
{
    protected const NUMERO_POR_VISTA = 4;
    /**
     * Create a new class instance.
     */
    public function __construct(protected AvisoRepository $repository)
    {
    }

    public function __invoke()
    {
        $principales = $this->repository->getPrincipales();

        while (sizeof($principales) % self::NUMERO_POR_VISTA != 0) {
            $cantidad = ceil(sizeof($principales) / self::NUMERO_POR_VISTA) * self::NUMERO_POR_VISTA;

            $principales = $principales->concat($principales->slice(0, $cantidad - sizeof($principales)));
        }

        return $principales->chunk(self::NUMERO_POR_VISTA);
    }
}
