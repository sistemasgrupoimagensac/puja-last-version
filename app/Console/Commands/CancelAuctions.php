<?php

namespace App\Console\Commands;

use App\Models\Aviso;
use App\Models\HistorialAvisos;
use App\Models\Remate;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CancelAuctions extends Command
{
    protected $signature = 'app:cancel-auctions';
    
    protected $description = 'Actualizar el estado de los anuncios según su fecha de vencimiento';

    public function handle()
    {

        $auctions =
            Aviso::join('inmuebles as i', 'i.id', '=', 'avisos.inmueble_id')
                ->join('principal_inmuebles as pi', 'pi.inmueble_id', '=', 'i.id')
                ->join('operaciones_tipos_inmuebles as o', 'o.principal_inmueble_id', '=', 'pi.id')
                ->join('caracteristicas_inmuebles as c', 'c.principal_inmueble_id', '=', 'pi.id')
                ->where([
                    'o.tipo_operacion_id' =>  3,
                    'avisos.estado' =>  1,
                ])
                ->whereHas('historial', function ($q) {
                    $q->where('estado_aviso_id', 3)
                        ->orderByDesc('historial_avisos.id')
                    ->limit(1);
                })
                ->select([
                    'avisos.id AS aviso_id',
                    'c.id AS caracteristica_id'
                ])
        ->get();

        if ( count($auctions) > 0 ) {
            foreach ($auctions as $auction) {
                $remate = Remate::where('caracteristicas_inmueble_id', $auction->caracteristica_id)->orderBy('numero_remate','DESC')->first();
                
                if ( $remate ) {
                    $date = "{$remate->fecha} {$remate->hora}";
                    if ( Carbon::parse($date)->lessThan(Carbon::now()) ) {
                        $aviso = Aviso::find($auction->aviso_id);
                        if ( $aviso ) {
                            HistorialAvisos::create([
                                'aviso_id' => $aviso->id,
                                'estado_aviso_id' => 7,
                            ]);
                        }
                    }
                }
            }
        }
        
    }
}
