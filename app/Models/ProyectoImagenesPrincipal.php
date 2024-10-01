<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProyectoImagenesPrincipal extends Model
{
    protected $table = 'proyecto_imagenes_principales';

    protected $fillable = [
        'proyecto_id',
        'image_url',
        'descripcion',
        'estado', // 1 = activa, 0 = eliminada
    ];

    // Relación con el proyecto
    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'proyecto_id');
    }
}
