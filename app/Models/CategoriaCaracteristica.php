<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CategoriaCaracteristica extends Model
{
    use HasFactory;

    protected $table = "categoria_caracteristicas_extra";
    protected $fillable = ['categoria', 'estado'];

    public function caracteristicas(): HasMany
    {
        return $this->hasMany(Caracteristica::class, 'categoria_caracteristica_id');
    }
}
