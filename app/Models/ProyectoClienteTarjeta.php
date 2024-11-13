<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProyectoClienteTarjeta extends Model
{
    protected $table = 'proyecto_cliente_tarjetas'; // Nombre de la tabla actualizado

    protected $fillable = [
        'proyecto_cliente_id', // ID del cliente de proyecto (antes `user_id`)
        'customer_id', // ID del cliente en el sistema de pago
        'card_id', // ID de la tarjeta en el sistema de pago
        'card_brand', // Marca de la tarjeta (e.g., Visa, MasterCard)
        'card_last_digits', // Últimos dígitos de la tarjeta
        'expiration_month', // Mes de expiración
        'expiration_year', // Año de expiración
    ];

    public function proyectoCliente()
    {
        return $this->belongsTo(ProyectoCliente::class, 'proyecto_cliente_id');
    }
}