<?php

namespace App\Events;

use App\Professor;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ProfessorDetailDelete
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $professor;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Professor $professor)
    {
        $this->professor = $professor;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
