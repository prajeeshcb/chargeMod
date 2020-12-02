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

class StartTransaction implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $chargingActivity;
   
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(ChargingActivity $chargingActivity)
    {/*
       $this->connectorId = $connectorId;
       $this->IdTag = $IdTag;
       $this->meterStart = $meterStart;
       $this->reservationId = $reservationId;
       $this->timestamp = Carbon::now();*/
       $this->chargingActivity = $chargingActivity;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        //return new PrivateChannel('charging');
        return new PrivateChannel('chat');

    }

    public function broadcastWith() 
    {
        $res= [
            'messageTypeId' => $this->chargingActivity->messageTypeId,
            'UniqueId' => $this->chargingActivity->UniqueId,
            'payload_data' => [
                  'TransactionId' => $this->chargingActivity->id,
                  'IdTagInfo' =>[
                     'name' => $this->chargingActivity->name,
                     'model' => $this->chargingActivity->model,
                     'charging_time' => $this->chargingActivity->charging_time,
                     'charging_pin_id' => $this->chargingActivity->charging_pin_id,
                    ], 
                /*'meterStart' => $this->meterStart,
                'reservationId' => $this->reservationId,
                'timestamp' => $this->timestamp,*/
            ]
      ];
      return $res;
    }
}
