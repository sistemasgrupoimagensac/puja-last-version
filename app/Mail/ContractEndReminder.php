<?php

namespace App\Mail;

use App\Models\ProyectoCliente;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContractEndReminder extends Mailable
{
    use Queueable, SerializesModels;

    public $cliente;

    public function __construct(ProyectoCliente $cliente)
    {
        $this->cliente = $cliente;
    }

    public function build()
    {
        return $this->subject('Recordatorio de Finalización de Contrato')
                    ->view('emails.contract_end_reminder');
    }
}
