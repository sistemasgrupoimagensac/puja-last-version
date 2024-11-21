<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\ProyectoPlanesActivos;
use App\Mail\PromocionRenovacion;
use Carbon\Carbon;

class PromocionRenovacionCommand extends Command
{
    protected $signature = 'renovacion:promocion';

    protected $description = 'Envía correos promocionales a usuarios sin renovación automática.';

    public function handle()
    {
        $hoy = Carbon::today();
        $fechaFinProxima = $hoy->addDays(45);

        $planes = ProyectoPlanesActivos::with('proyectoCliente.user')
            ->where('fecha_fin', $fechaFinProxima)
            ->where('renovacion_automatica', false)
            ->where('estado', 'activo')
            ->get();

        foreach ($planes as $plan) {
            $user = $plan->proyectoCliente->user;

            if ($user) {
                Mail::to($user->email)->send(new PromocionRenovacion($plan));

                $this->info("Correo promocional enviado a {$user->email} para el plan ID: {$plan->id}");
            }
        }

        return Command::SUCCESS;
    }
}
