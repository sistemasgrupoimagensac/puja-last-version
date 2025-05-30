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
        'mantenimiento',

        'remate_precio_base',
        'remate_valor_tasacion',
        'remate_partida_registral',
        'remate_direccion_id',
        'remate_direccion',
        'remate_nombre_centro',
        'remate_fecha',
        'remate_hora',
        'remate_nombre_contacto',
        'remate_telef_contacto',
        'remate_correo_contacto',
        'remate_edicto',

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

    public function remates()
    {
        return $this->hasMany(Remate::class, 'caracteristicas_inmueble_id');
    }

    public function nextRemate()
    {
        return
            $this->remates()
                ->vigente()
                ->orderBy('fecha', 'asc')
                ->orderBy('hora', 'asc')
            ->first();
    }

}
