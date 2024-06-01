<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UbicacionInmueble extends Model
{
    use HasFactory;

    protected $table = "ubicaciones_inmuebles";
    protected $fillable = ['principal_inmueble_id', 'direccion', 'departamento_id', 'provincia_id', 'distrito_id', 'latitud', 'longitud', 'estado'];

    public function principalInmueble(): BelongsTo
    {
        return $this->belongsTo(PrincipalInmueble::class, 'principal_inmueble_id');
    }

    public function departamento(): BelongsTo
    {
        return $this->belongsTo(Departamento::class, 'departamento_id');
    }

    public function provincia(): BelongsTo
    {
        return $this->belongsTo(Provincia::class, 'provincia_id');
    }

    public function distrito(): BelongsTo
    {
        return $this->belongsTo(Distrito::class, 'distrito_id');
    }
}
