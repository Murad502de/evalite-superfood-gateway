<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class emailVerificationCodeRequested
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $email;
    public $confirmCode;

    public function __construct($email, $confirmCode)
    {
        $this->email       = $email;
        $this->confirmCode = $confirmCode;
    }
}
