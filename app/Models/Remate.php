<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Remate extends Model
{
    use HasFactory;

    protected $table = 'remates';

    protected $fillable = [
        'numero_remate',
        'caracteristicas_inmueble_id',
        'base_remate',
        'valor_tasacion',
        'fecha',
        'hora',
    ];

    public function caracteristicasInmueble()
    {
        return $this->belongsTo(CaracteristicaInmueble::class);
    }

    public function scopeVigente($query)
    {
        $now = Carbon::now();

        return $query->where(function($q) use ($now) {
            $q->where('fecha', '>', $now->toDateString())
                ->orWhere(function($subQ) use ($now) {
                    $subQ->where('fecha', $now->toDateString())
                        ->where('hora', '>', $now->format('H:i:s'));
                });
        });
    }
}
