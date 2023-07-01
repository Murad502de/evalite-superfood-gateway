<?php

namespace App\Listeners;

use App\Events\PayoutApprovedEvent;
use App\Mail\PayoutApprovedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class PayoutApprovedListener implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {}

    /**
     * Handle the event.
     */
    public function handle(PayoutApprovedEvent $event): void
    {
        Mail::to($event->user->email)->send(new PayoutApprovedMail($event->payout));
    }
}
