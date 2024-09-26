<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgresoProyecto extends Model
{
    protected $table = 'progreso_proyecto';

    // Definir los campos que son fillable
    protected $fillable = ['estado'];
}
