<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'habilitado',
        'activo',
        'vigente',
        'pagado',
        'al_dia',
        'precio_plan',
        'periodo_plan',
        'pago_unico',
        'pago_fraccionado',
        'renovacion',
        'contrato_url',
        'mensualidad',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relación con proyectos
    public function proyectos(): HasMany
    {
        return $this->hasMany(Proyecto::class, 'proyecto_cliente_id');
    }
    
    // relacion con la tabla de representantes legales
    public function representantesLegales(): HasMany
    {
        return $this->hasMany(ProyectoClienteLegal::class);
    }

    public function cronogramaPagos()
    {
        return $this->hasMany(ProyectoCronogramaPago::class, 'proyecto_cliente_id');
    }


    public function contactos(): HasMany
    {
        return $this->hasMany(ProyectoClienteContacto::class);
    }

    public function googleSheet()
    {
        return $this->hasOne(ProyectoClienteSheet::class);
    }

    // Relacion con la tabla customer_cards (que contiene los datos de la tarjeta y el cliente)
    public function tarjeta()
    {
        return $this->hasOne(ProyectoClienteTarjeta::class, 'proyecto_cliente_id');
    }

}
