<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProyectoClienteSheet extends Model
{
    protected $fillable = [
        'proyecto_cliente_id', 
        'google_sheet_url', 
        'sheet_habilitado'
    ];

    public function proyectoCliente(): BelongsTo
    {
        return $this->belongsTo(ProyectoCliente::class);
    }
}
