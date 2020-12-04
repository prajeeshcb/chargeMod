<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\ChargingActivity;
class MeterValues
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $chargingActivity;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(ChargingActivity $chargingActivity)
    {
         $this->chargingActivity = $chargingActivity;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('chat');
    }


    public function broadcastWith() 
    {
        return [
        'configuration' => [
            'messageTypeId' => 3,
            'UniqueId' => $this->chargingActivity->UniqueId
            ]
        ];
    }
}
