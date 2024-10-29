<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProyectoLead extends Model
{
    use HasFactory;

    protected $table = 'proyecto_leads';

    protected $fillable = [
        'nombre',
        'correo',
        'telefono',
        'mensaje',
        'estado',
        'respondio',
        'interesado',
        'fecha_contacto',
    ];

    protected $casts = [
        'respondio' => 'boolean',
        'interesado' => 'boolean',
        'fecha_contacto' => 'date',
    ];
}