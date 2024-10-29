<?php

namespace App\Repositories;

use App\Models\TipoInmueble;

class TipoInmuebleRepository
{
    protected TipoInmueble $model;

    public function __construct()
    {
        $this->model = app()->make(TipoInmueble::class);
    }

    public function getBySlug($slug)
    {
        return $this->model->where('slug', $slug)->where('estado', 1)->first();
    }

    public function getById($id)
    {
        return $this->model->where('id', $id)->where('estado', 1)->first();
    }

    public function getAll()
    {
        return $this->model->where('estado', 1)->get();
    }
}
