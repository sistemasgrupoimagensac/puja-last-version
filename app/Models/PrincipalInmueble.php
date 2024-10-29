<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PrincipalInmueble extends Model
{
    use HasFactory;

    protected $table = "principal_inmuebles";
    protected $fillable = ['inmueble_id', 'estado',];

    public function inmueble(): BelongsTo
    {
        return $this->belongsTo(Inmueble::class, 'inmueble_id');
    }

    public function operacion(): HasOne
    {
        return $this->hasOne(OperacionTipoInmueble::class, 'principal_inmueble_id');
    }

    public function ubicacion(): HasOne
    {
        return $this->hasOne(UbicacionInmueble::class, 'principal_inmueble_id');
    }

    public function caracteristicas(): HasOne
    {
        return $this->hasOne(CaracteristicaInmueble::class, 'principal_inmueble_id');
    }
}
