<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OperacionTipoInmueble extends Model
{
    use HasFactory;

    protected $table = "operaciones_tipos_inmuebles";
    protected $fillable = ['principal_inmueble_id', 'tipo_operacion_id', 'tipo_inmueble_id', 'subtipo_inmueble_id', 'estado'];

    public function principalInmueble(): BelongsTo
    {
        return $this->belongsTo(PrincipalInmueble::class, 'principal_inmueble_id');
    }

    public function tipoOperacion(): BelongsTo
    {
        return $this->belongsTo(TipoOperacion::class, 'tipo_operacion_id');
    }

    public function tipoInmueble(): BelongsTo
    {
        return $this->belongsTo(TipoInmueble::class, 'tipo_inmueble_id');
    }

    public function subTipoInmueble(): BelongsTo
    {
        return $this->belongsTo(SubTipoInmueble::class, 'subtipo_inmueble_id');
    }
}
