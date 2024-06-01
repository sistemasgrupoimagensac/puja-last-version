<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoOperacion extends Model
{
    use HasFactory;

    protected $table = "tipos_operaciones";
    protected $fillable = ['tipo', 'estado',];
}
