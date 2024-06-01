<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Aviso extends Model
{
    use HasFactory;

    protected $table = "inmuebles";
    protected $fillable = ['inmueble_id', 'fecha_publicacion', 'estado',];

    protected function casts(): array
    {
        return [
            'fecha_publicacion' => 'datetime',
        ];
    }

    public function inmueble(): BelongsTo
    {
        return $this->belongsTo(Inmueble::class, 'inmueble_id');
    }

    public function historial(): BelongsToMany
    {
        return $this->belongsToMany(EstadoAviso::class, 'historial_avisos', 'aviso_id', 'estado_aviso_id');
    }
}
