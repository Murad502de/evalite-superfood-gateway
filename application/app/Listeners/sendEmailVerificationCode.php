<?php

namespace App\Listeners;

use App\Events\emailVerificationCodeRequested;
use App\Mail\User\ConfirmMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class sendEmailVerificationCode implements ShouldQueue
{
    public function __construct()
    {}

    public function handle(emailVerificationCodeRequested $event): void
    {
        Mail::to($event->email)->send(new ConfirmMail($event->confirmCode));
    }
}
