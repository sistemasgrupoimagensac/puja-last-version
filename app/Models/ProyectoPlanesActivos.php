<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProyectoPlanesActivos extends Model
{
    use HasFactory;

    protected $table = 'proyecto_planes_activos';

    protected $fillable = [
        'proyecto_cliente_id',
        'proyecto_planes_id',
        'fecha_inicio',
        'fecha_fin',
        'monto',
        'duracion',
        'renovacion_automatica',
        'estado',
    ];

    // Relación con ProyectoCliente
    public function proyectoCliente()
    {
        return $this->belongsTo(ProyectoCliente::class, 'proyecto_cliente_id');
    }

    // Relación con ProyectoPlanes
    public function proyectoPlanes()
    {
        return $this->belongsTo(ProyectoPlanes::class, 'proyecto_planes_id');
    }

    public function scopeSinRenovacion($query)
    {
        return $query->where('renovacion_automatica', false)
            ->where('estado', 'activo')
            ->whereDate('fecha_fin', '>=', now()->addDays(45));
    }

    public function scopeConRenovacion($query)
    {
        return $query->where('renovacion_automatica', true)
            ->where('estado', 'activo')
            ->whereDate('fecha_fin', '=', now()->addDays(45));
    }
}