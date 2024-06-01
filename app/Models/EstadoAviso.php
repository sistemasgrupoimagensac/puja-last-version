<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoAviso extends Model
{
    use HasFactory;

    protected $table = "estados_avisos";
    protected $fillable = ['estado', 'color'];
}
