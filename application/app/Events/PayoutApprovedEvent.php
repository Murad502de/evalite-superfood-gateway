<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PayoutApprovedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $payout;

    /**
     * Create a new event instance.
     */
    public function __construct($user, $payout)
    {
        $this->user = $user;
        $this->payout = $payout;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
