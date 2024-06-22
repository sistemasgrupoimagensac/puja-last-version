<?php

namespace App\Services\Url;

use App\Repositories\TipoInmuebleRepository;
use App\Repositories\TipoOperacionRepository;
use Illuminate\Support\Str;

class ParsearUrl
{
    const DELIMITER = "-en-";

    public function __construct(protected ?TipoInmuebleRepository $tipo_inmueble_repository, protected ?TipoOperacionRepository $tipo_operacion_repository)
    {        
    }

    public static function forSingle(string $slug): int
    {
        $url_parts = explode('-', $slug);
        $id = end($url_parts);
        if (!is_numeric($id)) {
            throw new \Exception("No es un id valido", 404);
        }

        return (int) $id;
    }

    public function forFilter(string $slug): array
    {
        $url_parts = explode(self::DELIMITER, $slug);
        $tipo_inmueble = $operacion = $direccion = null;
        if (array_key_exists(0, $url_parts)) {
            $tipo_inmueble = $url_parts[0];
            $tipo_inmueble = $this->tipo_inmueble_repository->getBySlug($tipo_inmueble);
        }

        if (array_key_exists(1, $url_parts)) {
            $operacion = $url_parts[1];
            $operacion = $this->tipo_operacion_repository->getBySlug($operacion);
        }

        if (array_key_exists(2, $url_parts)) {
            $direccion = str_replace('-', ' ', $url_parts[2]);
        }

        return [
            'tipo_inmueble' => $tipo_inmueble,
            'operacion'     => $operacion,
            'direccion'     => $direccion,
        ];
    }

    public function makeUrl($tipo_inmueble = null, $tipo_operacion = null, $direccion = null): string
    {
        $inmuebles_url = 'inmuebles';
        $operacion_url = 'venta-y-alquiler';
        $direccion_url = null;

        $inmueble = $tipo_inmueble ? $this->tipo_inmueble_repository->getById($tipo_inmueble) : null;
        $operacion = $tipo_operacion ? $this->tipo_operacion_repository->getById($tipo_operacion) : null;
        $address = $direccion ? Str::slug($direccion) : null;


        if ($inmueble) {
            $inmuebles_url = $inmueble->slug;
        }

        if ($operacion) {
            $operacion_url = $operacion->slug;
        }

        if ($address && !empty(trim($address))) {
            $direccion_url = self::DELIMITER . trim($address);
        }

        return $inmuebles_url . self::DELIMITER . $operacion_url . $direccion_url;
    }
}
