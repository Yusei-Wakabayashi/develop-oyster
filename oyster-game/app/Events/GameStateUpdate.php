<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class GameStateUpdate implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $room, $game;

    /**
     * Create a new event instance.
     */
    public function __construct($room,$game)
    {
        $this->room = $room;
        $this->game = $game;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn()
    {
        return ['room.' . $this->room->id];
    }

    public function broadcastAs()
    {
        return 'GameStateUpdate';
    }

    public function broadcastWith()
    {
        return [
            'board' => $this->game->board,
        ];
    }
}