<?php

namespace App\Console\Commands;

use App\Models\Aviso;
use App\Models\HistorialAvisos;
use App\Models\PlanUser;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class AdExpired extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:ad-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Este CRON va a cambiar al estado vencido los avisos que culminaron su tiempo de publicación segun su Plan contratado.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $currentDate = Carbon::now();
        $avisos = Aviso::whereNotNull('plan_user_id')
                    ->whereHas('historial', function($query) {
                        $query->where('estado_aviso_id', 3);
                    })
        ->get();
        Log::info("Cantidad de avisos publicados: {$avisos->count()} hasta \"{$currentDate}\" horas, antes de actualizar los vencidos.");

        $cont_avisos_caducados = 0;
        foreach ($avisos as $aviso) {
            $planUser = PlanUser::find($aviso->plan_user_id);

            if ($planUser && $planUser->end_date < $currentDate) {
                // $aviso->historial()->update(['estado_aviso_id' => 5]);
                HistorialAvisos::create([
                    'aviso_id' => $aviso->id,
                    'estado_aviso_id' => 5,
                ]);
                $cont_avisos_caducados++;
                Log::info("Aviso ID {$aviso->id} ha sido actualizado a estado 5 (Vencido).");
            }
        }
        if ( $cont_avisos_caducados === 0 ) {
            Log::info("No hubo avisos caducados.");
        }
        $this->info('Este CRON va a cambiar al estado vencido los avisos que culminaron su tiempo de publicacion segun su Plan contratado.');
    }
}
