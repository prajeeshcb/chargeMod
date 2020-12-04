<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MeterValueController extends Controller
{
    public function meterValue(Request $request) {
    	if($request->MessageTypeId==2 ) 
        {
        	/*$charging_activity = ChargingActivity::find(94);
			$charging_activity->meter_start_reading = $request['data']['meterStop'];
			$charging_activity->stopped_at = Carbon::now();
			$charging_activity->status = 1; //charging stoped
			$charging_activity->save();*/

			$transactionId = Session::get('transactionId');

			$transaction_data = new TransactionData();
			$transaction_data->transaction_id = $transactionId;
			$transaction_data->context = $request['data']['transactionData']['stampledValue']['context'];
			$transaction_data->format = $request['data']['transactionData']['stampledValue']['format'];
			$transaction_data->measurand =$request['data']['transactionData']['stampledValue']['measurand'];
			$transaction_data->phase = $request['data']['transactionData']['stampledValue']['phase'];
			$transaction_data->location = $request['data']['transactionData']['stampledValue']['location'];
			$transaction_data->unit = $request['data']['transactionData']['stampledValue']['unit'];
			$transaction_data->save();

			$chargingActivity = ChargingActivity::select('status')
                ->where('charging_activities.id', $transactionId)->first();

			$UniqueId = $request->UniqueId;
			$chargingActivity['UniqueId'] = $UniqueId;
            $chargingActivity['messageTypeId'] = 3;
            $res= [
                'messageTypeId' => $chargingActivity->messageTypeId,
                'UniqueId' => $chargingActivity->UniqueId,
                'data' => [
                   
                        ], 
                    ]
                ];
    		broadcast(new MeterValues($chargingActivity))->toOthers(); 
            return $res;

    }
}
