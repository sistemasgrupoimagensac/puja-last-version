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

    // public function handle()
    // {
    //     // Fecha actual más 30 días
    //     $fechaAviso = Carbon::now()->addDays(30)->toDateString();

    //     // Buscar clientes con fecha_fin_contrato igual a la fecha de aviso
    //     // $clientes = ProyectoCliente::whereDate('fecha_fin_contrato', $fechaAviso)->get();
    //     $clientes = ProyectoCliente::all();

    //     foreach ($clientes as $cliente) {
    //         Mail::to($cliente->email_contacto)->send(new ContractEndReminder($cliente));
    //     }

    //     Log::info('Cron job ejecutado correctamente.');

    //     $this->info('Correo de recordatorio enviado a los clientes con contrato a 30 días de vencimiento.');
    // }

    // public function handle()
    // {
    //     // Fecha actual más 30 días
    //     $fechaAviso = Carbon::now()->addDays(30)->toDateString();

    //     // Obtener todos los clientes
    //     $clientes = ProyectoCliente::with('contactos')->get(); // Cargar la relación 'contactos'

    //     foreach ($clientes as $cliente) {
    //         foreach ($cliente->contactos as $contacto) {
    //             Mail::to($contacto->email)->send(new ContractEndReminder($cliente));
    //         }
    //     }

    //     Log::info('Cron job ejecutado correctamente.');

    //     $this->info('Correo de recordatorio enviado a los clientes con contrato a 30 días de vencimiento.');
    // }

    public function handle()
    {
        Log::info('Iniciando el envío de correo...');
        Mail::to('acreedor.pruebaspuja@gmail.com')
            ->cc(['soporte@pujainmobiliaria.com.pe'])
            ->bcc(['grupoimagen.908883889@gmail.com']);
        // ->send(new newAdMail('hola'));
        Log::info('Correo enviado.');

        // Mail::raw('Este es un correo de prueba', function ($message) {
        //     $message->to('acreedor.pruebaspuja@gmail.com')
        //             ->subject('Correo de prueba');
        // });
        
    }

}
