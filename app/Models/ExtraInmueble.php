<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ExtraInmueble extends Model
{
    use HasFactory;

    protected $table = "extras_inmuebles";
    protected $fillable = ['inmueble_id', 'estado'];

    public function inmueble(): BelongsTo
    {
        return $this->belongsTo(Inmueble::class, 'inmueble_id');
    }

    public function caracteristicas(): BelongsToMany
    {
        return $this->belongsToMany(Caracteristica::class, 'extra_inmueble_caracteristicas', 'extra_inmueble_id', 'caracteristica_extra_id');
    }
}
