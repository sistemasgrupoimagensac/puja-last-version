<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProyectoImagenesUnidades extends Model
{
    protected $table = 'proyecto_imagenes_unidades';

    protected $fillable = [
        'proyecto_unidades_id',
        'proyecto_id',   // Añadir el campo `proyecto_id` para establecer la relación con el proyecto
        'image_url',
        'estado',
        'descripcion',
    ];

    // Relación con la tabla de unidades del proyecto
    public function unidad()
    {
        return $this->belongsTo(ProyectoUnidades::class, 'proyecto_unidades_id');
    }

    // Relación con la tabla de proyectos
    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'proyecto_id');
    }
}
