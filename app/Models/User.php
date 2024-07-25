<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'tipo_usuario_id',
        'codigo_unico',
        'nombres',
        'apellidos',
        'email',
        'password',
        'direccion',
        'google_id',
        'tipo_documento_id',
        'numero_documento',
        'celular',
        'imagen',
        'estado',
        'acepta_termino_condiciones',
        'acepta_confidencialidad',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'estado'   => 'boolean',
        ];
    }

    public function tipoUsuario(): BelongsTo
    {
        return $this->belongsTo(TipoUsuario::class, 'tipo_usuario_id');
    }

    public function active_plans()
    {
        return $this->belongsToMany(Plan::class, 'plan_user')
            ->as('plan_user')
            ->withPivot('id','typical_ads_remaining', 'top_ads_remaining', 'premium_ads_remaining', 'start_date', 'end_date')
            ->wherePivot('estado', 1);
    }

    public function tipoDocumento(): BelongsTo
    {
        return $this->belongsTo(TipoDocumento::class, 'tipo_documento_id');
    }

    public function inmuebles(): HasMany
    {
        return $this->hasMany(Inmueble::class, 'user_id');
    }

    public function getDniAttribute()
    {
        return $this->attributes['numero_documento'];
    }

    public function getNameAttribute()
    {
        return $this->attributes['nombres'];
    }

    public function getLastNameAttribute()
    {
        return $this->attributes['apellidos'];
    }

    public function getAddressAttribute()
    {
        return "Calle Random 123 -- Accesor";
    }

    public function getBusinessNameAttribute()
    {
        return $this->attributes['nombres'];
    }

    public function getEmailAttribute()
    {
        return $this->attributes['email'];
    }

    public function getPhoneAttribute()
    {
        return $this->attributes['celular'];
    }
}
