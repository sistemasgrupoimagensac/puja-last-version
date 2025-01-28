<?php

namespace App\Models;

use App\Notifications\RecoveryPasswordNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Passwords\CanResetPassword;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

// class User extends Authenticatable implements MustVerifyEmail
class User extends Authenticatable implements MustVerifyEmail, FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable, CanResetPassword, HasRoles;

    protected $fillable = [
        'tipo_usuario_id',
        'codigo_unico',
        'nombres',
        'apellidos',
        'email',
        'email_verified_at',
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
        'created_by',
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

    public function proyecto_cliente()
    {
        return $this->hasOne(ProyectoCliente::class, 'user_id');
    }

    // Método para verificar si el usuario puede publicar proyectos
    public function canPublishProjects()
    {
        $proyectoCliente = $this->proyecto_cliente;
    
        if (!$proyectoCliente) {
            return false; // Si no tiene un proyectoCliente asociado, no puede publicar
        }
    
        return [
            'activo' => $proyectoCliente->activo,
            'pagado' => $proyectoCliente->pagado,
            'al_dia' => $proyectoCliente->al_dia, // Nuevo campo que indica si el cliente está al día
            'numero_anuncios' => $proyectoCliente->numero_anuncios,
            'periodo_plan' => $proyectoCliente->periodo_plan,
            'fecha_inicio_contrato' => $proyectoCliente->fecha_inicio_contrato,
            'fecha_fin_contrato' => $proyectoCliente->fecha_fin_contrato,
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
        /* $direccion = "Calle sin Direccion TEST";
        if ( $this->attributes['direccion'] ) {
            $direccion = $this->attributes['direccion'];
        }
        return $direccion; */
        return $this->attributes['direccion'] ?? "";
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

    public function sendPasswordResetNotification($token): void
    {
        $url = route('password.reset', ['token' => $token, 'email' => $this->email]);
    
        $this->notify(new RecoveryPasswordNotification($url));
    }

    public function canAccessPanel(Panel $panel): bool
    {
        // return $this->tipoUsuario->nombres === 'Admin' && $this->hasVerifiedEmail();
        // return $this->nombres === 'Admin';
        // return $this->hasAnyRole(['admin', 'asesor_venta']);
        return true;
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
