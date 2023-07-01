<?php

namespace App\Mail;

use App\Models\Payout;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PayoutApprovedMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $payout;

    /**
     * Create a new message instance.
     */
    public function __construct($payout)
    {
        $this->payout = $payout;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject:'Payout Approved Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown:'mail.user.payout_approved',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        $receipt = $this->payout->getMedia(Payout::MEDIA_PREFIX_RECEIPT . $this->payout->uuid)->first();

        return [
            Attachment::fromPath($receipt->getPath())->as('Квитанция об оплате')->withMime($receipt->mime_type),
        ];
    }
}
