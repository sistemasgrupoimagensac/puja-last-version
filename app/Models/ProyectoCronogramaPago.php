<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProyectoCronogramaPago extends Model
{
    use HasFactory;

    protected $table = 'proyecto_cronograma_pago';

    protected $fillable = [
        'proyecto_cliente_id',
        'due_date',
        'amount',
        'estado_pago_id',
        'attempts',
        'retry_until',
        'last_attempt_date',
        'failure_reason',
        'final_failed',
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
