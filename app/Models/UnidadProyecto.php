<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnidadProyecto extends Model
{
    protected static function booted()
    {
        // Cada vez que se guarde o modifique una unidad, recalcular los valores en el proyecto
        static::saved(function ($unidad) {
            $unidad->proyecto->recalcularValores();
        });

        // También recalcular si la unidad es eliminada
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
