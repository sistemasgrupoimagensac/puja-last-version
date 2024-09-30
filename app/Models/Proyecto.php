<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    protected $table = 'proyectos';

    protected $fillable = [
        'nombre_proyecto',
        'unidades_cantidad',
        'banco_id',
        'proyecto_progreso_id',
        'descripcion',
        'fecha_entrega',
        'area_desde',
        'area_hasta',
        'area_techada_desde',
        'area_techada_hasta',
        'dormitorios_desde',
        'dormitorios_hasta',
        'banios_desde',
        'banios_hasta',
        'precio_desde',
    ];

    public function unidades()
    {
        return $this->hasMany(ProyectoUnidades::class);
    }

    public function banco()
    {
        return $this->belongsTo(Banco::class);
    }

    public function progreso()
    {
        return $this->belongsTo(ProyectoProgreso::class, 'proyecto_progreso_id');
    }

    // Modificar el método para recalcular solo con unidades activas
    public function recalcularValores()
    {
        // Filtrar solo las unidades con estado = 1
        $unidadesActivas = $this->unidades()->where('estado', 1);

        $this->update([
            'area_desde' => $unidadesActivas->min('area'),
            'area_hasta' => $unidadesActivas->max('area'),
            'area_techada_desde' => $unidadesActivas->min('area_techada'),
            'area_techada_hasta' => $unidadesActivas->max('area_techada'),
            'dormitorios_desde' => $unidadesActivas->min('dormitorios'),
            'dormitorios_hasta' => $unidadesActivas->max('dormitorios'),
            'banios_desde' => $unidadesActivas->min('banios'),
            'banios_hasta' => $unidadesActivas->max('banios'),
            'precio_desde' => $unidadesActivas->min('precio_soles'),
        ]);
    }
}
