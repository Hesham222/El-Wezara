<?php

namespace App\Events\Organization;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StoreCheckInPOItemsEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $po_id;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($po_id)
    {
        $this->po_id = $po_id;
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
