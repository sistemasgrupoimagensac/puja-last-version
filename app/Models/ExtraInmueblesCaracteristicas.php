<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExtraInmueblesCaracteristicas extends Model
{
    use HasFactory;

    protected $table = "extra_inmueble_caracteristicas";
    protected $fillable = ['extra_inmueble_id', 'caracteristica_extra_id', 'estado'];
}
