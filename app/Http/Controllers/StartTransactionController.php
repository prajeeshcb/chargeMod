<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\StartTransaction;
use App\ChargingActivity;
use Auth;
use Session;
use Carbon\Carbon;
use DB;
use App\Heartbeat;
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
            $charging->status = 1;// charging started
    		$charging->started_at = Carbon::now();
    		$charging->save();

    		$transactionId = $charging->id;
            $UniqueId = $request->UniqueId;

            Session::put('transactionId', $transactionId);
            Session::put('idTag', $request['data']['idTag']);

            $chargingActivity = ChargingActivity::leftJoin('vehicles', 'vehicles.id', '=', 'charging_activities.vehicle_tag_id')
                ->select('charging_activities.id as id', 'vehicles.name', 'vehicles.model', 'vehicles.charging_time', 'vehicles.charging_pin_id', 'vehicles.id as tagId', 'charging_activities.vehicle_tag_id')
                ->where('charging_activities.id', $transactionId)->first();
            $chargingActivity['UniqueId'] = $UniqueId;
            $chargingActivity['messageTypeId'] = 3;
            $res= [
                'messageTypeId' => $chargingActivity->messageTypeId,
                'UniqueId' => $chargingActivity->UniqueId,
                'data' => [
                      'TransactionId' => $chargingActivity->id,
                      'IdTagInfo' =>[
                         'name' => $chargingActivity->name,
                         'model' => $chargingActivity->model,
                         'charging_time' => $chargingActivity->charging_time,
                         'charging_pin_id' => $chargingActivity->charging_pin_id,
                        ], 
                    ]
                ];
    		broadcast(new StartTransaction($chargingActivity))->toOthers();
            return $res;
        }
        // $data=new Heartbeat();
        //     $data->message=$request['data']['message'];
        //     $data->save();
        //     $beats= Heartbeat()::all();
        //     return response()->json($beats);

    }
    public function fetchbeats()
    { 
        alert("HIIIIIIIII");
        return Heartbeat::all();
    }



    
}
