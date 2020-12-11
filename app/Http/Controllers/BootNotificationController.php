<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\BootNotification;
use Session;
use Carbon\Carbon;
use App\ChargePoint;

class BootNotificationController extends Controller
{
    public function bootNotification(Request $request) 
    {
    	if($request->MessageTypeId==2) 
        {
		
    		$charge_point = ChargePoint::select('interval')
    						->where('charge_point_vendor', '=', $request['data']['chargePointVendor'])
    						->where('charge_point_model', '=', $request['data']['chargePointModel'])
    						->where('charge_point_serialnumber', '=', $request['data']['chargePointSerialNumber'])
    						->where('charge_box_serial_number', '=', $request['data']['chargeBoxSerialNumber'])
    						->where('firmware_version', '=', $request['data']['firmwareVersion'])
    						->where('iccid', '=', $request['data']['iccid'])  
    						->where('imsi', '=', $request['data']['imsi'])  
    						->where('meter_type', '=', $request['data']['meterType'])
    						->where('meter_serial_number', '=', $request['data']['meterSerialNumber'])
    						->first();
						
    		if($charge_point === null) {

    			$charge_point = new ChargePoint();
    			$charge_point->timeStamp = Carbon::now();
    			$charge_point->UniqueId = $request->UniqueId;
            	$charge_point->MessageTypeId = 3;
    			$charge_point->status = "Rejected";
    			$res = [
            		'MessageTypeId' => $charge_point->MessageTypeId,
            		'UniqueId' => $charge_point->UniqueId,
            		'data' => [
                  		'status' => $charge_point->status ,
                  		'currentTime' => $charge_point->timeStamp
               		]
            	];
            }
            else {
                Session::put('connector_id', $request['data']['chargePointVendor']);
            	$charge_point->timeStamp = Carbon::now();
    			$charge_point->UniqueId = $request->UniqueId;
            	$charge_point->MessageTypeId = 3;
            	$charge_point->status = "Accepted";
            	$res = [
            		'MessageTypeId' => $charge_point->MessageTypeId,
            		'UniqueId' => $charge_point->UniqueId,
            		'data' => [
                  		'status' => $charge_point->status,
                  		'currentTime' => $charge_point->timeStamp,
                  		'interval' =>  $charge_point->interval
               		]
            	];
			}
			
            broadcast(new BootNotification($charge_point))->toOthers();
    		return $res;
		}
		
    }
}
