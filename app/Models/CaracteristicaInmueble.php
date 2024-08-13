<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CaracteristicaInmueble extends Model
{
    use HasFactory;

    protected $table = "caracteristicas_inmuebles";
    protected $fillable = [
        'principal_inmueble_id',
        'is_puja',
        'habitaciones',
        'banios',
        'medio_banios',
        'estacionamientos',
        'area_construida',
        'area_total',
        'antiguedad',
        'anios_antiguedad',
        'precio_soles',
        'precio_dolares',

        'remate_precio_base',
        'remate_valor_tasacion',
        'remate_partida_registral',
        'remate_direccion',
        'remate_fecha',
        'remate_hora',
        'remate_nombre_contacto',
        'remate_telef_contacto',
        'remate_correo_contacto',

        'titulo',
        'descripcion',
        'estado'
    ];

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
        return 'USD ';
    }
}
