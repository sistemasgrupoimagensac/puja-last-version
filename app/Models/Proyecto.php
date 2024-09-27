<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    // Definir la tabla con el nombre correcto
    protected $table = 'proyectos';

    // Definir los campos que son fillable
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

    // Relación con las unidades del proyecto
    public function unidades()
    {
        return $this->hasMany(ProyectoUnidades::class);
    }

    // Relación con el banco
    public function banco()
    {
        return $this->belongsTo(Banco::class);
    }

    // Relación con el estado de progreso del proyecto
    public function progreso()
    {
        return $this->belongsTo(ProyectoProgreso::class, 'proyecto_progreso_id');
    }

    // Método para recalcular los valores de las unidades asociadas
    public function recalcularValores()
    {
        $this->update([
            'area_desde' => $this->unidades()->min('area'),
            'area_hasta' => $this->unidades()->max('area'),
            'area_techada_desde' => $this->unidades()->min('area_techada'),
            'area_techada_hasta' => $this->unidades()->max('area_techada'),
            'dormitorios_desde' => $this->unidades()->min('dormitorios'),
            'dormitorios_hasta' => $this->unidades()->max('dormitorios'),
            'banios_desde' => $this->unidades()->min('banios'),
            'banios_hasta' => $this->unidades()->max('banios'),
            'precio_desde' => $this->unidades()->min('precio_soles'),
        ]);
    }
}
