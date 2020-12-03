<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\ChargePoint;
class BootNotification
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $chargePoint;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(ChargePoint $chargePoint)
    {
        $this->chargePoint = $chargePoint;
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
        if($this->$charge_point->status == "Accepted")
        {
            $res= [
                'messageTypeId' => $this->chargePoint->messageTypeId,
                'UniqueId' => $this->chargePoint->UniqueId,
                'data' => [
                            'status' => $this->$charge_point->status,
                            'currentTime' => $this->$charge_point->timeStamp,
                            'interval' =>  $this->$charge_point->interval
                        ]
            ];
        }
        else
        {
            $res= [
                'messageTypeId' => $this->chargePoint->messageTypeId,
                'UniqueId' => $this->chargePoint->UniqueId,
                'data' => [
                            'status' => $this->$charge_point->status,
                            'currentTime' => $this->$charge_point->timeStamp
                        ]
            ];
        }
      return $res;
    }
}
