<?php

namespace App\Listeners;

use App\Events\PayoutApprovedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

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
    }
}
