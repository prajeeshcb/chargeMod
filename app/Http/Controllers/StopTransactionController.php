<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\StopTransaction;
use App\ChargingActivity;
use App\TransactionData;
use Auth;
use Session;
use Carbon\Carbon;
use File;
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
          
    		broadcast(new StopTransaction($chargingActivity))->toOthers();
    		$request->session()->forget($transactionId);
            return $chargingActivity;


        }
	}
	public function JSONstopreq()
	{
		$data = json_encode(['{"MessageTypeId":"2","UniqueId":"754557","Action":"StopTransaction","data":{"idTag": "567890","meterStop":"3333","reason":"Emergency stop","transactionData":{"stampledValue":{"context":"other","format":"signedData","location":"EV","measurand":"Power offered","phase":"LI","unit":"Kwh"},"timeStamp":"02-10-2020"},"transactionId":"23345"}}']);
        $file = time() .rand(). '_file.json';
        $destinationPath=public_path()."/upload/";
        if (!is_dir($destinationPath)) {  mkdir($destinationPath,0777,true);  }
        File::put($destinationPath.$file,$data);
        return response()->download($destinationPath.$file);
	}
	public function JSONstopres()
	{
		$data = json_encode(['{"MessageTypeId":"3","UniqueId":"754557","Action":"StopTransactionResponse",data":{"status":"2"}}']);
        $file = time() .rand(). '_file.json';
        $destinationPath=public_path()."/upload/";
        if (!is_dir($destinationPath)) {  mkdir($destinationPath,0777,true);  }
        File::put($destinationPath.$file,$data);
        return response()->download($destinationPath.$file);
	}
}
