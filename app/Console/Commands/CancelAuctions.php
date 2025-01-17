<?php

namespace App\Console\Commands;

use App\Models\Aviso;
use App\Models\Remate;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CancelAuctions extends Command
{
    protected $signature = 'app:cancel-auctions';
    
    protected $description = 'Actualizar el estado de los anuncios según su fecha de vencimiento';

    public function handle()
    {
        Log::info("Cron job ejecutado: Cancelar remates");

        $auctions =
            Aviso::join('inmuebles as i', 'i.id', '=', 'avisos.id')
                ->join('historial_avisos as h', 'h.aviso_id', '=', 'avisos.id')
                ->join('principal_inmuebles as pi', 'pi.inmueble_id', '=', 'i.id')
                ->join('operaciones_tipos_inmuebles as o', 'o.principal_inmueble_id', '=', 'pi.id')
                ->join('caracteristicas_inmuebles as c', 'c.principal_inmueble_id', '=', 'pi.id')
                ->where([
                    'o.tipo_operacion_id' =>  3,
                    'h.estado_aviso_id' =>  3,
                ])
                ->select([
                    'avisos.id AS aviso_id',
                    'c.id AS caracteristica_id'
                ])
        ->get();

        if ( count($auctions) > 0 ) {
            foreach ($auctions as $auction) {
                $remate = Remate::where('caracteristicas_inmueble_id', $auction->caracteristica_id)->orderBy('numero_remate','DESC')->first();
                $date = "{$remate->fecha} {$remate->hora}"; // Esto espero obtener: "2025-01-10 15:59:00"

                if (!$remate) {
                    Log::warning("Remate no encontrado para caracteristica_id: {$auction->caracteristica_id}");
                    continue;
                }

                if ( $remate ) {
                    if ( Carbon::parse($date)->lessThan(Carbon::now()) ) {
                        $aviso = Aviso::find($auction->aviso_id);
                        if (!$aviso) {
                            Log::warning("Aviso no encontrado para aviso_id: {$auction->aviso_id}");
                            continue;
                        }
                        if ( $aviso ) {
                            $aviso->historial->first()->pivot->estado_aviso_id = 7;
                            $aviso->historial->first()->pivot->save();
                            Log::info("Aviso {$auction->aviso_id} cancelado correctamente.");
                        }
                    } else {
                        Log::info("Aviso {$auction->aviso_id} aun cuenta con vigencia su ultimo remate es el {$date} ");
                    }
                }
            }
        } else {
            Log::info("No se encontraron remates para cancelar.");
        }

    }
}
