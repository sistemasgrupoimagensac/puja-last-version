<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlanoInmueble extends Model
{
    use HasFactory;

    protected $table = "planos_multimedia_inmuebles";
    protected $fillable = ['multimedia_inmueble_id', 'plano', 'estado'];

    public function multimedia(): BelongsTo
    {
        return $this->belongsTo(MultimediaInmueble::class, 'multimedia_inmueble_id');
    }
}
