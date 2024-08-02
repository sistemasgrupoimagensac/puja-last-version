<?php

namespace App\Mail;

use App\Models\Aviso;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class newAdMail extends Mailable
{
    use Queueable, SerializesModels;

    public $aviso;
    /**
     * Create a new message instance.
     */
    public function __construct($aviso_id)
    {
        $aviso = Aviso::findOrFail($aviso_id);
        $this->aviso = $aviso;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nuevo Aviso Subido en el portal de Puja Inmobiliaria.',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.new-ad',
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
