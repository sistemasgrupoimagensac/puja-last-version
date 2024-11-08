<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

class ProyectoClienteContacto extends Model
{
    use Notifiable;

    protected $table = 'proyecto_cliente_contactos';

    protected $fillable = [
        'proyecto_cliente_id',
        'nombre',
        'telefono',
        'email',
        'habilitado_correo',
    ];

    public function proyectoCliente(): BelongsTo
    {
        return $this->belongsTo(ProyectoCliente::class);
    }
}
