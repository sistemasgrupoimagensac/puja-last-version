<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TipoInmueble extends Model
{
    use HasFactory;

    protected $table = "tipos_inmuebles";
    protected $fillable = ['tipo', 'estado', 'plural', 'slug',];

    public function subTiposInmuebles(): HasMany
    {
        return $this->hasMany(subTipoInmueble::class, 'tipo_inmueble_id');
    }
}
