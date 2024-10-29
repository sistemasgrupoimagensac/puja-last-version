<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendProjectMail extends Mailable
{
    use Queueable, SerializesModels;

    public $proyecto_contact;
    public $proyecto_url;
    /**
     * Create a new message instance.
     */
    public function __construct($proyecto_contact, $proyecto_url)
    {
        $this->proyecto_contact = $proyecto_contact;
        $this->proyecto_url = $proyecto_url;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            // from: new Address( env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME') ),
            replyTo: [
                new Address( $this->proyecto_contact->email, $this->proyecto_contact->full_name ),
            ],
            subject: 'Nuevo contacto interesado en su inmueble.',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.send-project-data',
            // with: [
            //     'orderName' => $this->order->name,
            //     'orderPrice' => $this->order->price,
            // ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
