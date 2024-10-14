<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProyectoCliente extends Model
{
    protected $fillable = [
        'user_id',
        'razon_social',
        'ruc',
        'direccion_fiscal',
        'telefono_inmobiliaria',
        'nombre_comercial',
        'representante_legal',
        'direccion_representante',
        'nombre_contacto',
        'telefono_contacto',
        'email_contacto',
        'fecha_inicio_contrato',
        'fecha_fin_contrato',
        'numero_anuncios',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
