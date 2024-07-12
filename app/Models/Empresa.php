<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;
    
    protected $table = "empresas";
    protected $fillable = ['state', 'status_electronic_billing', 'name', 'logo', 'logo_menu', 'path'];

    public function electronicBilling()
    {
        return $this->hasOne(FacturacionElectronica::class, 'empresa_id');
    }
}
