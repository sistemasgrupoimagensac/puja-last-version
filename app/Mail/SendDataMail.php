<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendDataMail extends Mailable
{
    use Queueable, SerializesModels;

    public $ad_contact;
    /**
     * Create a new message instance.
     */
    public function __construct($ad_contact)
    {
        $this->ad_contact = $ad_contact;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            // from: new Address( '' ),
            // from: new Address( env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME') ),
            replyTo: [
                new Address( env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME') ),
            ],
            subject: 'Nuevo contacto interesado',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.send-data',
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
