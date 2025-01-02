<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaccion extends Model
{
    use HasFactory;

    // Especifica el nombre de la tabla
    protected $table = 'transacciones';

    // Campos que pueden ser asignados masivamente
    protected $fillable = [
        'amount',
        'plan_id',
        'currency',
        'customer_name',
        'customer_email',
        'customer_phone_number',
        'description',
        'tipo_usuario_id',
        'status',
        'card_bank_code',
        'card_bank_name',
        'card_holder_name',
        'card_type',
        'creation_date',
        'error_description',
        'error_code',
        'request_id',
    ];

    // Si tienes fechas adicionales, puedes especificarlas aquí
    protected $dates = [
        'creation_date',
    ];
}
