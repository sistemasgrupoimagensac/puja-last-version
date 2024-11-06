<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPlanProject extends Model
{
    use HasFactory;

    protected $fillable = [
        'proyecto_cliente_id',
        'subscription_id',
        'status',
        'start_date',
        'end_date'
    ];

    /**
     * Relación con ProyectoCliente.
     */
    public function proyectoCliente()
    {
        return $this->belongsTo(ProyectoCliente::class, 'proyecto_cliente_id');
    }
}
