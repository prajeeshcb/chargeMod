<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\StartTransaction;
use App\ChargingActivity;
use Auth;
use Session;
class StartTransactionController extends Controller
{

/*  structure for  start Transaction Request  
	{
    "$schema": "http://json-schema.org/draft-04/schema#",
    "title": "StartTransactionRequest",
    "type": "object",
    "properties": {
        "connectorId": {
            "type": "integer"
        },
        "idTag": {
            "type": "string",
            "maxLength": 20
        },
        "meterStart": {
            "type": "integer"
        },
        "reservationId": {
            "type": "integer"
        },
        "timestamp": {
            "type": "string",
            "format": "date-time"
        }
    },
    "additionalProperties": false,
    "required": [
        "connectorId",
        "idTag",
        "meterStart",
        "timestamp"
    ]
	}
*/
	public function start(Request $request) 
	{
        if($request->MessageTypeId==2) 
        {
    		$charging = new ChargingActivity();
    		$charging->user_id = Auth::user()->id;
            $charging->station_id = 1;
    		$charging->connector_id = $request['data']['connectorId'];
    		$charging->vehicle_tag_id = $request['data']['idTag'];
    		$charging->meter_start_reading = $request['data']['meterStart'];
            $charging->reservation_id = $request['data']['reservationId'];
    		$charging->started_at = date('Y-m-d H:i:s');
    		$charging->save();

    		$transactionId = $charging->id;
            $UniqueId = $request->UniqueId; 

            $chargingActivity = ChargingActivity::leftJoin('vehicles', 'vehicles.id', '=', 'charging_activities.vehicle_tag_id')
                ->select('charging_activities.id as id', 'vehicles.name', 'vehicles.model', 'vehicles.charging_time', 'vehicles.charging_pin_id', 'vehicles.id as tagId', 'charging_activities.vehicle_tag_id')
                ->where('charging_activities.id', $transactionId)->first();
            $chargingActivity['UniqueId'] = $UniqueId;
            $chargingActivity['messageTypeId'] = 3;
    		broadcast(new StartTransaction($chargingActivity))->toOthers();
            return $chargingActivity;
        }

	}


    
}