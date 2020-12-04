<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\StopTransaction;
use App\ChargingActivity;
use App\TransactionData;
use Auth;
use Session;
use Carbon\Carbon;

class StopTransactionController extends Controller
{
    
    public function stop(Request $request) {
    	if($request->MessageTypeId==2 ) 
        {
        	$transactionId = Session::get('transactionId');
        	$charging_activity = ChargingActivity::find($transactionId );
			$charging_activity->meter_end_reading = $request['data']['meterStop'];
			$charging_activity->stopped_at = Carbon::now();
			$charging_activity->status = 2; //charging stoped
			$charging_activity->save();

			
			//return $transactionId;

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
            if($chargingActivity['status'] == 2)
            {
            	$chargingActivity['status'] = 'Accepted';	
            }
            $res = [
		            'messageTypeId' => 3,
		            'UniqueId' => $chargingActivity->UniqueId,
		            'IdTagInfo' =>[
		                     'status' => "Accepted",
		                    ], 
           			];
            $json[] = Session::get('payload.data');
            array_push($json,$res);
            Session::put('payload.data', $json);
            return (Session::get('payload.data'));
    		broadcast(new StopTransaction($chargingActivity))->toOthers();
    		$request->session()->forget($transactionId);
            return $chargingActivity;


        }
    }
}
