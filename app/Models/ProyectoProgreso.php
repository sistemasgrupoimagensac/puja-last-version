<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProyectoProgreso extends Model
{
    // Definir la tabla con el nombre actualizado
    protected $table = 'proyecto_progreso';

    // Definir los campos que son fillable
    protected $fillable = ['estado'];

    // Relación con los proyectos que tienen este progreso
    public function proyectos()
    {
        return $this->hasMany(Proyecto::class, 'proyecto_progreso_id');
    }
}
