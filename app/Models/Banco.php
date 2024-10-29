<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banco extends Model
{
    protected $table = 'bancos';

    // Definir los campos que son fillable
    protected $fillable = ['nombre'];
}
