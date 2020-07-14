<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Database\Eloquent\Collection;
use App\User;
use App\clients\NewsLetters;
use Illuminate\Support\Facades\Log;

class NewNewsLetter
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $NewsLetter;
    public $users;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(NewsLetters $NewsLetter, Collection $users)
    {
        $this->newsLetter = $NewsLetter;
        $this->users = $users;

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
