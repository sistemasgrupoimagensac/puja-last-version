<?php

namespace App\Mail;

use App\Models\Aviso;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendConfirmationToContact extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Aviso $aviso, public string $url)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Hemos recibido tu interés del inmueble',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mails.send-confirmation-to-contact',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
