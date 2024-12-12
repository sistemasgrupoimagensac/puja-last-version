<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class ProyectoCronogramaPago extends Model
{
    use HasFactory;

    protected $table = 'proyecto_cronograma_pagos';

    protected $fillable = [
        'proyecto_cliente_id',
        'proyecto_plan_activo_id',
        'fecha_programada',
        'monto',
        'estado_pago_id',
        'intentos',
        'reintento_hasta',
        'fecha_ultimo_intento',
        'razon_fallo',
        'fallo_final',
    ];

    protected $casts = [
        'fecha_programada' => 'datetime',
        'reintento_hasta' => 'datetime',
        'fecha_ultimo_intento' => 'datetime',
    ];

    public function proyectoCliente()
    {
        return $this->belongsTo(ProyectoCliente::class, 'proyecto_cliente_id');
    }

    public function estadoPago()
    {
        return $this->belongsTo(ProyectoPagoEstado::class, 'estado_pago_id');
    }

    /**
     * Scope para obtener pagos pendientes para procesar hoy.
     */
    public function scopePendientesHoy(Builder $query): Builder
    {
        $hoy = Carbon::today();
        $estadoPendiente = 1; // ID del estado 'Pendiente'
        $estadoReintento = 4; // ID del estado 'Reintento'

        return $query->where(function ($q) use ($hoy, $estadoPendiente) {
                $q->where('estado_pago_id', $estadoPendiente)
                  ->whereDate('fecha_programada', $hoy);
            })
            ->orWhere(function ($q) use ($hoy, $estadoReintento) {
                $q->where('estado_pago_id', $estadoReintento)
                  ->whereDate('reintento_hasta', '>=', $hoy);
            });
    }
}
