<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProyectoImagenesAdicionales extends Model
{
    protected $table = 'proyecto_imagenes_adicionales';

    protected $fillable = [
        'proyecto_id',
        'image_url',
        'descripcion',
        'tipo', // Opcional: Categoría o tipo de imagen (e.g., "exterior", "interior", etc.)
        'orden', // Opcional: Para determinar el orden de las imágenes en el frontend
        'estado', // 1 = activa, 0 = eliminada
    ];

    // Relación con el proyecto
    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'proyecto_id');
    }
}
