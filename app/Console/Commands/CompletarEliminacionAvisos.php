<?php

namespace App\Console\Commands;

use App\Models\Aviso;
use App\Models\HistorialAvisos;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CompletarEliminacionAvisos extends Command
{
    protected $signature = 'app:completar-eliminacion-avisos';
    protected $description = 'Despues de 1 mes de elimados los avisos se cambian a estado ELIMINADO';

    public function handle()
    {
        $avisos = Aviso::where('estado', 1)
                ->whereHas('inmueble', fn($q) => $q->where('estado', 1))
                ->whereHas('historial', function ($q) {
                    $q->whereRaw('
                                        historial_avisos.id = (
                                            SELECT MAX(h2.id)
                                            FROM historial_avisos h2
                                            WHERE h2.aviso_id = historial_avisos.aviso_id
                                        )
                                        AND historial_avisos.estado_aviso_id = 8
                                    ');
                })
                ->select(
                    DB::raw("(select DATE(historial_avisos.created_at) from historial_avisos where aviso_id = avisos.id order by historial_avisos.id desc limit 1) AS fecha_estado_aviso"),
                    'avisos.id'
                )
                ->get();
        $now = Carbon::now();

        foreach($avisos as $aviso) {
            $fechaVencimiento = Carbon::parse($aviso->fecha_estado_aviso);
            if ($now->copy()->subMonth()->gte($fechaVencimiento)) {
                HistorialAvisos::create([
                    'aviso_id' => $aviso->id,
                    'estado_aviso_id' => 6,
                ]);
            }
        }
    }
}
