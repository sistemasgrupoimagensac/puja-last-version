<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProyectoClienteLegal extends Model
{
    protected $table = 'proyecto_cliente_legales';

    protected $fillable = [
        'proyecto_cliente_id',
        'nombre',
        'direccion',
        'tipo_documento',
        'numero_documento',
        'estado_civil',
    ];

    public function proyectoCliente(): BelongsTo
    {
        return $this->belongsTo(ProyectoCliente::class);
    }
}
