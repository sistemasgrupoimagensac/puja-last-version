<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SubscriptionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pdfPath;
    public $plan_name;

    /**
     * Create a new message instance.
     */
    public function __construct($pdfPath, $plan_name)
    {
        $this->pdfPath = $pdfPath;
        $this->plan_name = $plan_name;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $nombre_plan = $this->plan_name;
        return new Envelope(
            // from: new Address( env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME') ),
            subject: "Felicitaciones adquiriste un nuevo \"{$nombre_plan}\" - Puja Inmobiliaria",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.factura-electronica',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            Attachment::fromPath($this->pdfPath)
                // ->as('name.pdf')
                // ->withMime('application/pdf')
        ];
    }
}
