<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProyectoPagoEstado extends Model
{
    use HasFactory;

    protected $table = 'proyecto_pago_estados';

    protected $fillable = ['nombre'];

    public function pagos()
    {
        return $this->hasMany(ProyectoCronogramaPago::class, 'estado_pago_id');
    }
}
