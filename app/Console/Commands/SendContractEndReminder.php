<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ProyectoCliente;
use Carbon\Carbon;
use App\Mail\ContractEndReminder;
use App\Mail\newAdMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\SendProjectMail;
use App\Mail\SubscriptionMail;

class SendContractEndReminder extends Command
{
    /**
     * The console command description.
     *
     * @var string
     */
    protected $signature = 'contract:send-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email reminders 30 days before contract end date';

    public function handle()
    {
        // Fecha actual más 30 días
        $fechaAviso = Carbon::now()->addDays(30)->toDateString();

        // Obtener todos los clientes cuyo contrato vence en 30 días y cargar sus contactos
        $clientes = ProyectoCliente::with('contactos')->whereDate('fecha_fin_contrato', $fechaAviso)->get();

        foreach ($clientes as $cliente) {
            Log::info("cliente: {$cliente}");
            foreach ($cliente->contactos as $contacto) {
                Log::info("contacto: {$contacto}. Correo: {$contacto->email}");
                // Enviar correo a cada contacto de este cliente
                Mail::to($contacto->email)->send(new ContractEndReminder($cliente));
            }
        }

        Log::info("Cron job correo recordatorio ejecutado correctamente. {$fechaAviso}");
        $this->info('Correo de recordatorio enviado a los clientes con contrato a 30 días de vencimiento.');
    }


}
