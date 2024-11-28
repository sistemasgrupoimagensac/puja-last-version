<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProyectoPlanesEstados extends Model
{
    use HasFactory;

    protected $table = 'proyecto_planes_estados';

    protected $fillable = [
        'nombre',
        'descripcion',
    ];
}
