<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $userName;
    public $roomId;
    public $message;
    public function __construct($userName, $roomId, $message)
    {
        $this->userName = $userName;
        $this->roomId = $roomId;
        $this->message = $message;
    }
    public function broadcastOn() : Channel
    {
        return new Channel('chat.' . $this->roomId);
    }
    public function broadcastWith()
    {
        return [
            'userName' => $this->userName,
            'message' => $this->message,
        ];
    }
}
