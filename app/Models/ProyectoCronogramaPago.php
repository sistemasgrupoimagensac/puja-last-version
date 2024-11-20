<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProyectoCronogramaPago extends Model
{
    use HasFactory;

    protected $table = 'proyecto_cronograma_pagos';

    protected $fillable = [
        'proyecto_cliente_id',
        'fecha_programada',
        'monto',
        'estado_pago_id',
        'intentos',
        'reintento_hasta',
        'fecha_ultimo_intento',
        'razon_fallo',
        'fallo_final',
    ];

    // Asegurarte que las fechas se manejen como objetos Carbon
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
}
