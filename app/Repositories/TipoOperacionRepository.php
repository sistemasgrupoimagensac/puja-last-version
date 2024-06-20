<?php

namespace App\Repositories;

use App\Models\TipoOperacion;

class TipoOperacionRepository
{
    protected TipoOperacion $model;

    public function __construct()
    {
        $this->model = app()->make(TipoOperacion::class);
    }

    public function getBySlug($slug)
    {
        return $this->model->where('slug', $slug)->where('estado', 1)->first();
    }

    public function getById($id)
    {
        return $this->model->where('id', $id)->where('estado', 1)->first();
    }
}
