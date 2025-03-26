<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialAvisos extends Model
{
    use HasFactory;

    protected $table = "historial_avisos";
    protected $fillable = ['aviso_id', 'estado_aviso_id', 'observacion'];
}
