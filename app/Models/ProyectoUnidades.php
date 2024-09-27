<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProyectoUnidades extends Model
{
    // Definir la tabla con el nombre actualizado
    protected $table = 'proyecto_unidades';

    // Definir los campos que son fillable
    protected $fillable = [
        'proyecto_id',
        'dormitorios',
        'precio_soles',
        'precio_dolares',
        'area',
        'area_techada',
        'banios',
        'piso_numero',
    ];

    // Evento que se dispara cada vez que se guarda o elimina una unidad
    protected static function booted()
    {
        // Recalcular los valores en el proyecto cada vez que se guarde o modifique una unidad
        static::saved(function ($unidad) {
            $unidad->proyecto->recalcularValores();
        });

        // Recalcular también si la unidad es eliminada
        static::deleted(function ($unidad) {
            $unidad->proyecto->recalcularValores();
        });
    }

    // Relación con el proyecto
    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class);
    }
}
