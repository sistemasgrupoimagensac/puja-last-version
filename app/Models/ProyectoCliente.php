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

    // Método para determinar si el cliente está activo
    public function actualizarEstado()
    {
        $hoy = now();
        // Verificar si el contrato está vigente
        $this->vigente = $this->fecha_fin_contrato >= $hoy && $hoy >= $this->fecha_inicio_contrato;

        // Verificar el estado activo
        if ($this->habilitado && $this->vigente) {
            $this->activo = true;
        } else {
            $this->activo = false;
        }

        $this->save();
    }

    // relacion con la tabla de representantes legales
    public function representantesLegales(): HasMany
    {
        return $this->hasMany(ProyectoClienteLegal::class);
    }

    public function contactos(): HasMany
    {
        return $this->hasMany(ProyectoClienteContacto::class);
    }

    // Evento para actualizar el estado cada vez que se recupera el cliente
    protected static function booted()
    {
        static::retrieved(function ($proyectoCliente) {
            $proyectoCliente->actualizarEstado();
        });
    }
}
