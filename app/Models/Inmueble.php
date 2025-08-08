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

    public function aviso(): HasOne
    {
        return $this->hasOne(Aviso::class, 'inmueble_id');
    }

    public function type()
    {
        return optional(optional(optional($this->principal)->operacion)->tipoOperacion)->tipo;
    }

    public function category()
    {
        return optional(optional(optional($this->principal)->operacion)->tipoInmueble)->tipo;
    }

    public function typeInmueble()
    {
        return optional(optional(optional($this->principal)->operacion)->tipoInmueble)->tipo;
    }

    public function imagenPrincipal()
    {
        return optional($this->multimedia)->imagen_principal;
    }

    public function imagenes()
    {
        return optional($this->multimedia)->imagenes();
    }

    public function planos()
    {
        return optional($this->multimedia)->planos();
    }

    public function videos()
    {
        return optional($this->multimedia)->videos();
    }

    public function currencySoles()
    {
        return optional(optional($this->principal)->caracteristicas)->currencySoles();
    }

    public function currencyDolares()
    {
        return optional(optional($this->principal)->caracteristicas)->currencyDolares();
    }

    public function idCaracteristica()
    {
        return optional(optional($this->principal)->caracteristicas)->id;
    }

    public function precioSoles()
    {
        return optional(optional($this->principal)->caracteristicas)->precio_soles;
    }

    public function precioDolares()
    {
        return optional(optional($this->principal)->caracteristicas)->precio_dolares;
    }

    public function tituloReal()
    {
        return optional(optional($this->principal)->caracteristicas)->titulo;
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

    public function departamento()
    {
        return optional(optional(optional($this->principal)->ubicacion)->departamento)->nombre;
    }

    public function title()
    {
        $tipo_inmueble = $this->category();
        $tipo_operacion = $this->type();
        $distrito = $this->distrito();

        // if($tipo_operacion === "Rematar") {
        //     $tipo_operacion = "Remate";
        // }

        if (is_null($tipo_inmueble) || is_null($tipo_operacion) || is_null($distrito)) {
            return 'Inmueble en Venta/Alquiler';
        }

        return sprintf('%s en %s en %s', $tipo_inmueble, $tipo_operacion, $distrito);
    }

    public function antiguedad()
    {
        return optional(optional($this->principal)->caracteristicas)->antiguedad;
    }

    public function aniosAntiguedad()
    {
        return optional(optional($this->principal)->caracteristicas)->anios_antiguedad;
    }

    public function area()
    {
        return optional(optional($this->principal)->caracteristicas)->area_total;
    }

    public function areaConstruida()
    {
        return optional(optional($this->principal)->caracteristicas)->area_construida;
    }

    public function is_puja()
    {
        return optional(optional($this->principal)->caracteristicas)->is_puja;
    }

    public function dormitorios()
    {
        return optional(optional($this->principal)->caracteristicas)->habitaciones;
    }

    public function mantenimiento()
    {
        return optional(optional($this->principal)->caracteristicas)->mantenimiento;
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

    /* public function remate_precio_base()
    {
        return optional(optional($this->principal)->caracteristicas)->remate_precio_base;
    }
    public function remate_valor_tasacion()
    {
        return optional(optional($this->principal)->caracteristicas)->remate_valor_tasacion;
    } */
    public function remate_partida_registral()
    {
        return optional(optional($this->principal)->caracteristicas)->remate_partida_registral;
    }
    public function remate_direccion()
    {
        return optional(optional($this->principal)->caracteristicas)->remate_direccion;
    }
    public function remate_nombre_centro()
    {
        return optional(optional($this->principal)->caracteristicas)->remate_nombre_centro;
    }
    /* public function remate_fecha()
    {
        return optional(optional($this->principal)->caracteristicas)->remate_fecha;
    }
    public function remate_hora()
    {
        return optional(optional($this->principal)->caracteristicas)->remate_hora;
    } */
    public function remate_nombre_contacto()
    {
        return optional(optional($this->principal)->caracteristicas)->remate_nombre_contacto;
    }
    public function remate_telef_contacto()
    {
        return optional(optional($this->principal)->caracteristicas)->remate_telef_contacto;
    }
    public function remate_correo_contacto()
    {
        return optional(optional($this->principal)->caracteristicas)->remate_correo_contacto;
    }


    public function nextRemate()
    {
        return optional(optional($this->principal)->caracteristicas)->nextRemate();
    }
    /* public function fecha_remate()
    {
        return optional($this->nextRemate())->fecha;
    }
    public function hora_remate()
    {
        return optional($this->nextRemate())->hora ? substr($this->nextRemate()->hora, 0, 5) : null;
    }
    public function base_remate()
    {
        return optional($this->nextRemate())->base_remate;
    }
    public function valor_tasacion_remate()
    {
        return optional($this->nextRemate())->valor_tasacion;
    } */

        /**
     * Obtener la fecha del próximo remate.
     */

    public function numero_remate()
    {
        return optional($this->nextRemate())->numero_remate;
    }
    public function remate_fecha()
    {
        return optional($this->nextRemate())->fecha;
    }
    public function remate_hora()
    {
        return optional($this->nextRemate())->hora ? substr($this->nextRemate()->hora, 0, 5) : null;
    }
    public function remate_precio_base()
    {
        return optional($this->nextRemate())->base_remate;
    }
    public function remate_valor_tasacion()
    {
        return optional($this->nextRemate())->valor_tasacion;
    }



    public function getPujaDescripcionAttribute()
    {
        $puja = $this->is_puja() == 1 ? "*Este aviso acepta ofertas en cuanto al precio que le ofrezcas.\n" : "";
        
    }

    public function getDescripcionAttribute()
    {
        $subtipo_inmueble = $this->principal->operacion->subTipoInmueble->subtipo;
        $tipo_operacion = $this->principal->operacion->tipoOperacion->tipo;
        $direccion_completa = 
            $this->address() . ' ' . 
            $this->principal->ubicacion->distrito->nombre . ', ' . 
            $this->principal->ubicacion->provincia->nombre . ', ' . 
            $this->principal->ubicacion->departamento->nombre . '. ';

        $habitaciones = '';
        if ( $this->typeInmueble() == 'Oficina' ) {
            if ( $this->dormitorios() == 1 ) $habitaciones = 'un ambiente, ';
            if ( $this->dormitorios() > 1 ) $habitaciones = $this->dormitorios() . ' ambientes, ';
        } else {
            if ( $this->dormitorios() == 1 ) $habitaciones = 'una habitación, ';
            if ( $this->dormitorios() > 1 ) $habitaciones = $this->dormitorios() . ' habitaciones, ';
        }
        $banios = '';
        if ( $this->banios() == 1 ) 'un baño, ';
        if ( $this->banios() > 1 ) $banios = $this->banios() . ' baños, ';
        $mediobanios = '';
        if ( $this->medioBanios() == 1 ) 'un medio baño, ';
        if ( $this->medioBanios() > 1 ) $mediobanios = $this->medioBanios() . ' medios baños, ';
        $estacionamientos = '';
        if ( $this->estacionamientos() == 1 ) 'un estacionamiento, ';
        if ( $this->estacionamientos() > 1 ) $estacionamientos = $this->estacionamientos() . ' estacionamientos, ';

        $espacios = "";
        if ( $this->dormitorios() >= 1 || $this->banios() >= 1 || $this->medioBanios() >= 1 || $this->estacionamientos() >= 1 ) {
            $espacios .= "En cuanto a espacios en el inmueble, este cuenta con: {$habitaciones}{$banios}{$mediobanios}{$estacionamientos}";
            $espacios = substr_replace($espacios, ".", -2);
        }

        $area_total_num = number_format($this->area(), 0, '', ',');
        $area_construida_num = number_format($this->areaConstruida(), 0, '', ',');
        $area_total = "cuenta con {$area_total_num} m² como área total,";
        $area_construida = "y {$area_construida_num} m² como área construida";
        $tipo_inmueble = $this->typeInmueble();
        $antiguedad = '';
        if ( $this->antiguedad() == "1" ) {
            $antiguedad = 'en estreno';
        } else if ( $this->antiguedad() == "0" ) {
            $antiguedad = 'en construcción';
        } else if ( $this->antiguedad() == "2" ) {
            $antiguedad = 'con ' . $this->aniosAntiguedad() . ' años de antiguedad';
        }
        $monto = '';
        $monto_soles = number_format($this->precioSoles(), 2, '.', ',');
        $monto_dolares = number_format($this->precioDolares(), 2, '.', ',');

        $venta_alquiler = $this->principal->operacion->tipoOperacion->slug;

        if ( $this->precioSoles() && $this->precioDolares() ) {
            $monto = " y el precio de {$venta_alquiler} es de S/ {$monto_soles} ó $ {$monto_dolares}";
        } else if ( $this->precioSoles() && !$this->precioDolares() ) {
            $monto = " y el precio de {$venta_alquiler} es de S/ {$monto_soles}";
        } else if ( !$this->precioSoles() && $this->precioDolares() ) {
            $monto = " y el precio de {$venta_alquiler} es de $ {$monto_dolares}";
        }
        $caracteristicas = "{$tipo_inmueble} {$antiguedad} {$area_total} {$area_construida}{$monto}" ;

        // REMATE
        $remate = "";
        if ( $this->remate_partida_registral() ) {
            $remate .= "Este inmueble en remate tiene la siguiente partida registral {$this->remate_partida_registral()}";
        }
        if ( $this->remate_direccion() ) {
            $remate .= ", la dirección del remate del inmueble es en {$this->remate_direccion()}";
        }
        if ( $this->remate_nombre_contacto() ) {
            $remate .= ", el nombre del contacto es {$this->remate_nombre_contacto()}";
        }
        if ( $this->remate_telef_contacto() ) {
            $remate .= " y su teléfono es {$this->remate_telef_contacto()}. ";
        }
        $caracteristicas_extras = "";
        $totalCaracteristicas = count($this->extra->caracteristicas);
        foreach ( $this->extra->caracteristicas as $key => $value) {
            $caracteristicas_extras .= $value->caracteristica;
            ( $key < $totalCaracteristicas - 1 ) ? $caracteristicas_extras .= ", " : $caracteristicas_extras .= ".";
        }

        $mantenimiento = '';
        if ( $this->mantenimiento() && $this->mantenimiento() > 0 ) {
            $precio_mantenimiento = number_format($this->mantenimiento(), 2, '.', ',');
            $mantenimiento = "El pago de mantenimiento es de S/ {$precio_mantenimiento}.";
        }

        $tlf_contacto = "El número de contacto para mayor información o citas es " . ($this->user->cel_contactar ?? $this->user->celular) . ".";

        return "{$subtipo_inmueble} en {$tipo_operacion} ubicada en {$direccion_completa}{$espacios} {$caracteristicas}. {$remate}El inmueble cuenta con una lista de características y comodidades que se presentan a continuación: {$caracteristicas_extras} {$mantenimiento} {$tlf_contacto}";
    }

}
