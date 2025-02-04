<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Aviso extends Model
{
    use HasFactory;

    protected $table = "avisos";
    protected $fillable = ['inmueble_id', 'ad_type', 'fecha_publicacion', 'estado', 'plan_user_id',];

    protected function casts(): array
    {
        return [
            'fecha_publicacion' => 'datetime',
        ];
    }

    public function inmueble(): BelongsTo
    {
        return $this->belongsTo(Inmueble::class, 'inmueble_id');
    }

    public function historial(): BelongsToMany
    {
        return $this->belongsToMany(EstadoAviso::class, 'historial_avisos', 'aviso_id', 'estado_aviso_id');
    }

    public function link()
    {
        return Str::slug($this->inmueble->title() . ' ' . $this->id);
    }

    public function contacts()
    {
        return $this->hasMany(AdContact::class);
    }

    public function planUser()
    {
        return $this->belongsTo(PlanUser::class, 'plan_user_id');
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, 'aviso_likes')->withTimestamps();
    }
}
