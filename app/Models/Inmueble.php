<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    public function fullName()
    {
        return optional(optional(optional($this->principal)->operacion)->tipoOperacion)->tipo . ' - ' . optional(optional(optional($this->principal)->operacion)->tipoInmueble)->tipo;
    }

    public function imagenPrincipal()
    {
        return optional($this->multimedia)->imagen_principal;
    }

    public function precioSoles()
    {
        $price = optional(optional($this->principal)->caracteristicas)->precio_soles;

        if (null == $price) {
            return null;
        }

        return 'S/ ' . number_format(optional(optional($this->principal)->caracteristicas)->precio_soles);
    }

    public function precioDolares()
    {
        $price = optional(optional($this->principal)->caracteristicas)->precio_dolares;

        if (null == $price) {
            return null;
        }

        return 'USD ' . number_format(optional(optional($this->principal)->caracteristicas)->precio_dolares);
    }

    public function address()
    {
        return optional(optional($this->principal)->ubicacion)->direccion;
    }

    public function ubicacionGeografica()
    {
        return optional(optional(optional($this->principal)->ubicacion)->distrito)->nombre . ', '. optional(optional(optional($this->principal)->ubicacion)->provincia)->nombre;
    }

    public function area()
    {
        return optional(optional($this->principal)->caracteristicas)->area_total;
    }

    public function dormitorios()
    {
        return optional(optional($this->principal)->caracteristicas)->habitaciones;
    }

    public function banios()
    {
        return optional(optional($this->principal)->caracteristicas)->banios;
    }
}
