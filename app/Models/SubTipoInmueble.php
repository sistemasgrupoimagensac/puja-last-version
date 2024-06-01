<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubTipoInmueble extends Model
{
    use HasFactory;

    protected $table = "subtipos_inmuebles";
    protected $fillable = ['tipo_inmueble_id', 'subtipo', 'estado',];

    public function tipoInmueble(): BelongsTo
    {
        return $this->belongsTo(TipoInmueble::class, 'tipo_inmueble_id');
    }
}
