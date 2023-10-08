<?php

namespace App\Listeners;

use App\Events\UserApprovedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserApprovedMail;

class UserApprovedListener implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {}

    /**
     * Handle the event.
     */
    public function handle(UserApprovedEvent $event): void
    {
        Mail::to($event->user->email)->send(new UserApprovedMail($event->user));
    }
}
