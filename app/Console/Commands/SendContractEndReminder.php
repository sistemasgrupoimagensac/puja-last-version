<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ProyectoCliente;
use Carbon\Carbon;
use App\Mail\ContractEndReminder;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SendContractEndReminder extends Command
{
    protected $signature = 'contract:send-reminder';
    protected $description = 'Send email reminders 30 days before contract end date';

    public function handle()
    {
        // Fecha actual más 30 días
        $fechaAviso = Carbon::now()->addDays(30)->toDateString();

        // Buscar clientes con fecha_fin_contrato igual a la fecha de aviso
        // $clientes = ProyectoCliente::whereDate('fecha_fin_contrato', $fechaAviso)->get();
        $clientes = ProyectoCliente::all();

        foreach ($clientes as $cliente) {
            Mail::to($cliente->email_contacto)->send(new ContractEndReminder($cliente));
        }

        Log::info('Cron job ejecutado correctamente.');

        $this->info('Correo de recordatorio enviado a los clientes con contrato a 30 días de vencimiento.');
    }
}
