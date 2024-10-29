<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProyectoClienteContacto extends Model
{
    protected $table = 'proyecto_cliente_contactos';

    protected $fillable = [
        'proyecto_cliente_id',
        'nombre',
        'telefono',
        'email',
    ];

    public function proyectoCliente(): BelongsTo
    {
        return $this->belongsTo(ProyectoCliente::class);
    }
}
