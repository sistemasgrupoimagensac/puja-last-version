<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PromocionRenovacion extends Mailable
{
    use Queueable, SerializesModels;

    public $plan;

    /**
     * Create a new message instance.
     */
    public function __construct($plan)
    {
        $this->plan = $plan;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this
            ->subject('¡Renueva tu plan y sigue publicando!')
            ->markdown('emails.promocion-renovacion');
    }
}
