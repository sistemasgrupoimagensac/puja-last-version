<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProyectoCronogramaPago extends Model
{
    use HasFactory;

    protected $table = 'proyecto_cronograma_pagos';

    protected $fillable = [
        'proyecto_cliente_id',    // Referencia al cliente del proyecto
        'fecha_programada',       // Fecha programada para el cobro
        'monto',                  // Monto a debitar
        'estado_pago_id',         // ID del estado del pago
        'intentos',               // Cantidad de intentos de cobro realizados
        'reintento_hasta',        // Fecha límite para reintentos
        'fecha_ultimo_intento',   // Fecha del último intento de cobro
        'razon_fallo',            // Razón de falla del cobro
        'fallo_final',            // Indicador de fallo después de todos los reintentos
    ];

    // Relación con ProyectoCliente
    public function proyectoCliente()
    {
        return $this->belongsTo(ProyectoCliente::class, 'proyecto_cliente_id');
    }

    // Relación con ProyectoPagoEstado
    public function estadoPago()
    {
        return $this->belongsTo(ProyectoPagoEstado::class, 'estado_pago_id');
    }
}
