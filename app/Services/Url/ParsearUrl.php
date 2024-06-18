<?php

namespace App\Services\Url;

class ParsearUrl
{
    public static function forSingle(string $slug): int
    {
        $url_parts = explode('-', $slug);
        $id = end($url_parts);
        if (!is_numeric($id)) {
            throw new \Exception("No es un id valido", 404);
        }

        return (int) $id;
    }
}
