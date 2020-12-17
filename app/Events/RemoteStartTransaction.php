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
use Carbon\Carbon;
class RemoteStartTransaction implements ShouldBroadcast
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
        $res= [
            'messageTypeId' => $this->chargingActivity->messageTypeId,
            'UniqueId' => $this->chargingActivity->UniqueId,
            'data' => [
                  'transactionId' => $this->chargingActivity->id,
                  'status' => $this->chargingActivity->status
            ]
      ];
      return $res;
    }
}
