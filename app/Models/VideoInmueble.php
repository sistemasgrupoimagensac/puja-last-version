<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VideoInmueble extends Model
{
    use HasFactory;

    protected $table = "videos_multimedia_inmuebles";
    protected $fillable = ['multimedia_inmueble_id', 'video', 'estado'];

    public function multimedia(): BelongsTo
    {
        return $this->belongsTo(MultimediaInmueble::class, 'multimedia_inmueble_id');
    }
}
