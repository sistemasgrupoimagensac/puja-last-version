<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ImagenInmueble extends Model
{
    use HasFactory;

    protected $table = "imagenes_multimedia_inmuebles";
    protected $fillable = ['multimedia_inmueble_id', 'imagen', 'estado'];

    public function multimedia(): BelongsTo
    {
        return $this->belongsTo(MultimediaInmueble::class, 'multimedia_inmueble_id');
    }
}
