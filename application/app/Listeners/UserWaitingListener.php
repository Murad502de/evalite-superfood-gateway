<?php

namespace App\Listeners;

use App\Events\UserWaitingEvent;
use App\Mail\UserWaitingMail;
use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class UserWaitingListener implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {}

    /**
     * Handle the event.
     */
    public function handle(UserWaitingEvent $event): void
    {
        $admin = User::whereHas('role', function ($query) {
            $query->where('code', Role::$ROLE_CODE_ADMIN);
        })->first();

        Mail::to($admin->email)->send(new UserWaitingMail($event->user));
    }
}
