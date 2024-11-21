<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\ProyectoPlanesActivos;
use \App\Mail\RenovacionRecordatorio;
use Carbon\Carbon;

class RecordatorioRenovacionCommand extends Command
{
    protected $signature = 'renovacion:recordatorio';

    protected $description = 'Envia recordatorios de renovación automática a los usuarios 45 días antes de que finalice su contrato.';

    public function handle()
    {
        $hoy = Carbon::today();
        $fechaRecordatorio = $hoy->addDays(45);

        $planes = ProyectoPlanesActivos::with('proyectoCliente.user')
            ->where('fecha_fin', $fechaRecordatorio)
            ->where('renovacion_automatica', true)
            ->where('estado', 'activo')
            ->get();

        foreach ($planes as $plan) {
            $user = $plan->proyectoCliente->user;

            if ($user) {
                Mail::to($user->email)->send(new RenovacionRecordatorio($plan));

                $this->info("Correo enviado a {$user->email} para el plan ID: {$plan->id}");
            }
        }

        return Command::SUCCESS;
    }
}
