<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

class Inmueble extends Model
{
    use HasFactory;

    protected $table = "inmuebles";
    protected $fillable = ['user_id', 'codigo_unico', 'estado',];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function principal(): HasOne
    {
        return $this->hasOne(PrincipalInmueble::class, 'inmueble_id');
    }

    public function multimedia(): HasOne
    {
        return $this->hasOne(MultimediaInmueble::class, 'inmueble_id');
    }

    public function extra(): HasOne
    {
        return $this->hasOne(ExtraInmueble::class, 'inmueble_id');
    }

    public function avisos(): HasMany
    {
        return $this->hasMany(Aviso::class, 'inmueble_id');
    }

    public function type()
    {
        return optional(optional(optional($this->principal)->operacion)->tipoOperacion)->tipo;
    }

    public function category()
    {
        return optional(optional(optional($this->principal)->operacion)->tipoInmueble)->tipo;
    }

    public function imagenPrincipal()
    {
        return optional($this->multimedia)->imagen_principal;
    }

    public function imagenes()
    {
        return optional($this->multimedia)->imagenes()->limit(3);
    }

    public function currencySoles()
    {
        return optional(optional($this->principal)->caracteristicas)->currencySoles();
    }

    public function currencyDolares()
    {
        return optional(optional($this->principal)->caracteristicas)->currencyDolares();
    }

    public function precioSoles()
    {
        return optional(optional($this->principal)->caracteristicas)->precio_soles;
    }

    public function precioDolares()
    {
        return optional(optional($this->principal)->caracteristicas)->precio_dolares;
    }

    public function address()
    {
        return optional(optional($this->principal)->ubicacion)->direccion;
    }

    public function distrito()
    {
        return optional(optional(optional($this->principal)->ubicacion)->distrito)->nombre;
    }

    public function provincia()
    {
        return optional(optional(optional($this->principal)->ubicacion)->provincia)->nombre;
    }

    public function title()
    {
        $tipo_inmueble = $this->category();
        $tipo_operacion = $this->type();
        $distrito = $this->distrito();

        if (is_null($tipo_inmueble) || is_null($tipo_operacion) || is_null($distrito)) {
            return 'Inmueble en Venta/Alquiler';
        }

        return sprintf('%s en %s en %s', $tipo_inmueble, $tipo_operacion, $distrito);
    }

    public function area()
    {
        return optional(optional($this->principal)->caracteristicas)->area_total;
    }

    public function areaConstruida()
    {
        return optional(optional($this->principal)->caracteristicas)->area_construida;
    }

    public function dormitorios()
    {
        return optional(optional($this->principal)->caracteristicas)->habitaciones;
    }

    public function banios()
    {
        return optional(optional($this->principal)->caracteristicas)->banios;
    }

    public function medioBanios()
    {
        return optional(optional($this->principal)->caracteristicas)->medio_banios;
    }

    public function estacionamientos()
    {
        return optional(optional($this->principal)->caracteristicas)->estacionamientos;
    }

    public function description()
    {
        return optional(optional($this->principal)->caracteristicas)->descripcion;
    }

    public function shortDescription()
    {
        $description = $this->description();

        if (null == $description) {
            return null;
        }

        $shortText = Str::limit($description, $this->charLimit());

        return $shortText;
    }

    public function charLimit(): int
    {
        return 300;
    }
}
