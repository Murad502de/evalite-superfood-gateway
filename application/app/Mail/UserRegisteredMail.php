<?php

namespace App\Mail;

use App\Traits\PdfTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserRegisteredMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels, PdfTrait;

    public $user;

    /**
     * Create a new message instance.
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject:'User Registered Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown:'mail.user.agency_contract',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {

        $data = $this->user->getAgencyContractData();
        $pdf  = $this->loadPdfFromView('agency_contract', $data);

        return [
            Attachment::fromData(fn() => $pdf->output(), 'Агентский договор на поиск клиентов.pdf')
                ->withMime('application/pdf'),
        ];
    }
}
