<?php

namespace App\Listeners;

use App\Events\passwordResetCodeRequested;
use App\Mail\User\PasswordResetCodeMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class sendPasswordResetCode implements ShouldQueue
{
    public function __construct()
    {}

    public function handle(passwordResetCodeRequested $event): void
    {
        Mail::to($event->email)->send(new PasswordResetCodeMail($event->confirmCode));
    }
}
