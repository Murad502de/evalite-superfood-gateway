<?php

namespace App\Listeners;

use App\Events\UserApprovedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log; //DELETE

class UserApprovedListener implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        Log::info(__METHOD__); //DELETE
    }

    /**
     * Handle the event.
     */
    public function handle(UserApprovedEvent $event): void
    {
        Log::info(__METHOD__, [$event->user->email]); //DELETE
    }
}
