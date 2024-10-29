<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MultimediaInmueble extends Model
{
    use HasFactory;

    protected $table = "multimedia_inmuebles";
    protected $fillable = ['inmueble_id', 'imagen_principal', 'estado'];

    public function inmueble(): BelongsTo
    {
        return $this->belongsTo(Inmueble::class, 'inmueble_id');
    }

    public function imagenes(): HasMany
    {
        return $this->hasMany(ImagenInmueble::class, 'multimedia_inmueble_id');
    }

    public function videos(): HasMany
    {
        return $this->hasMany(VideoInmueble::class, 'multimedia_inmueble_id');
    }

    public function planos(): HasMany
    {
        return $this->hasMany(PlanoInmueble::class, 'multimedia_inmueble_id');
    }
}
