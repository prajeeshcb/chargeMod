<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StopTransaction
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
            'UniqueId' => $this->chargingActivity->UniqueId,
            'data' => [
                  'TransactionTd' => $this->chargingActivity->id,
                  'IdTagInfo' =>[
                     'name' => $this->chargingActivity->name,
                     'model' => $this->chargingActivity->model,
                     'charging_time' => $this->chargingActivity->charging_time,
                     'charging_pin_id' => $this->chargingActivity->charging_pin_id,
                    ], 
                /*'meterStart' => $this->meterStart,
                'reservationId' => $this->reservationId,
                'timestamp' => $this->timestamp,*/
            ],
        ]
      ];
    }
}


