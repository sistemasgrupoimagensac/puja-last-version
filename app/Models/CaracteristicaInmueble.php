<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CaracteristicaInmueble extends Model
{
    use HasFactory;

    protected $table = "caracteristicas_inmuebles";
    protected $fillable = ['principal_inmueble_id', 'habitaciones', 'banios', 'medio_banios', 'estacionamientos', 'area_construida', 'area_total', 'antiguedad', 'anios_antiguedad', 'precio_soles', 'precio_dolares', 'titulo', 'descripcion', 'estado'];

    public function principalInmueble(): BelongsTo
    {
        return $this->belongsTo(PrincipalInmueble::class, 'principal_inmueble_id');
    }

    public function currencySoles() :string
    {
        return 'S/ ';
    }

    public function currencyDolares() :string
    {
        return '$';
    }
}
