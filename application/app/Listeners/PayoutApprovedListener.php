<?php

namespace App\Listeners;

use App\Events\PayoutApprovedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\PayoutApprovedMail;

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
        Log::info(__METHOD__, [$event->payout]); //DELETE
        Mail::to($event->user->email)->send(new PayoutApprovedMail($event->payout));
    }
}
