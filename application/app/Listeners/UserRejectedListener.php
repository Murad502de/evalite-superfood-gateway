<?php

namespace App\Listeners;

use App\Events\UserRejectedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserRejectedMail;

class UserRejectedListener implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {}

    /**
     * Handle the event.
     */
    public function handle(UserRejectedEvent $event): void
    {
        Mail::to($event->user->email)->send(new UserRejectedMail($event->user));
    }
}
