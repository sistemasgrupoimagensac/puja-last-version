<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProyectoPlanes extends Model
{
    use HasFactory;

    protected $table = 'proyecto_planes';

    protected $fillable = [
        'nombre',
        'descripcion',
        'duracion_en_meses',
    ];
}
