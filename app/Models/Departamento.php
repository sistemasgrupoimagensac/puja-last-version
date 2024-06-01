<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Departamento extends Model
{
    use HasFactory;

    protected $table = 'departamentos';
    protected $fillable = ['nombre', 'estado'];

    public function provincias(): HasMany
    {
        return $this->hasMany(Provincia::class, 'departamento_id');
    }

    public function distritos(): HasMany
    {
        return $this->hasMany(Distrito::class, 'departamento_id');
    }
}
