<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacturacionElectronica extends Model
{
    use HasFactory;

    protected $table = "fact_electronica";
    // protected $fillable = ['state', 'status_electronic_billing', 'name', 'logo', 'logo_menu', 'path'];
}
