<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Caracteristica extends Model
{
    use HasFactory;

    protected $table = "caracteristicas_extra";
    protected $fillable = ['categoria_caracteristica_id', 'caracteristica', 'estado'];

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(CategoriaCaracteristica::class, 'categoria_caracteristica_id');
    }
}
