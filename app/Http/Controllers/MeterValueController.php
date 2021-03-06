<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\MeterValues;
use Session;
use App\TransactionData;
use App\ChargingActivity;
use File;
class MeterValueController extends Controller
{
    public function meterValue(Request $request) 
    {
    	if($request->MessageTypeId==2 ) 
        {
        	/*$charging_activity = ChargingActivity::find(94);
			$charging_activity->meter_start_reading = $request['data']['meterStop'];
			$charging_activity->stopped_at = Carbon::now();
			$charging_activity->status = 1; //charging stoped
			$charging_activity->save();*/
			$transactionId = Session::get('transactionId');
			$transaction = TransactionData::select('transaction_data.id', 'transaction_data.transaction_id', 'charging_activities.connector_id')
							->leftJoin('charging_activities', 'charging_activities.id','transaction_data.transaction_id')
							->where('charging_activities.connector_id', '=', $request['data']['connectorId'])
							->where('transaction_data.transaction_id', '=', $transactionId)->first();
			if ($transaction === null) {
	   			$transaction_data = new TransactionData();
				$transaction_data->transaction_id = $transactionId;
				//$transaction_data->connector_id = $request['data']['connectorId'];
				$transaction_data->context = $request['data']['meterValue']['stampledValue']['context'];
				$transaction_data->format = $request['data']['meterValue']['stampledValue']['format'];
				$transaction_data->measurand =$request['data']['meterValue']['stampledValue']['measurand'];
				$transaction_data->phase = $request['data']['meterValue']['stampledValue']['phase'];
				$transaction_data->location = $request['data']['meterValue']['stampledValue']['location'];
				$transaction_data->unit = $request['data']['meterValue']['stampledValue']['unit'];
				$transaction_data->save();
			}
			else 
			{
				$transaction_data = TransactionData::find($transaction['id']);
				$transaction_data->transaction_id = $transactionId;
				//$transaction_data->connector_id = $request['data']['connectorId'];
				$transaction_data->context = $request['data']['meterValue']['stampledValue']['context'];
				$transaction_data->format = $request['data']['meterValue']['stampledValue']['format'];
				$transaction_data->measurand =$request['data']['meterValue']['stampledValue']['measurand'];
				$transaction_data->phase = $request['data']['meterValue']['stampledValue']['phase'];
				$transaction_data->location = $request['data']['meterValue']['stampledValue']['location'];
				$transaction_data->unit = $request['data']['meterValue']['stampledValue']['unit'];
				$transaction_data->save();
			}

			

			$chargingActivity = ChargingActivity::select('status')
                ->where('charging_activities.id', $transactionId)->first();

			$UniqueId = $request->UniqueId;
			$chargingActivity['UniqueId'] = $UniqueId;
            $chargingActivity['messageTypeId'] = 3;
            $res= [
                'MessageTypeId' => $chargingActivity->messageTypeId,
                'UniqueId' => $chargingActivity->UniqueId,
                'data' => [
                   
                        ], 
                    ];
       
    		broadcast(new MeterValues($chargingActivity))->toOthers(); 
            return json_encode($res);

    	}
	
	}
	public function JSONmeterreq()
	{
		$data = json_encode(['{"MessageTypeId":"2","UniqueId":"342337","Action":"MeterValues","data":{"connectorId":"1111","meterValue":{"stampledValue":{"context":"other","format":"signedData","location":"EV","measurand":"Power offered","phase":"LI","unit":"Kwh"},"timeStamp":"02-10-2020",},"transactionId":"32434",}}']);
        $file = time() .rand(). '_file.json';
        $destinationPath=public_path()."/upload/";
        if (!is_dir($destinationPath)) {  mkdir($destinationPath,0777,true);  }
        File::put($destinationPath.$file,$data);
        return response()->download($destinationPath.$file);
	}
	public function JSONmeterres()
	{
		$data = json_encode(['{"MessageTypeId":"3","UniqueId":"342337","Action":"MeterValuesResponse","data":[]}']);
        $file = time() .rand(). '_file.json';
        $destinationPath=public_path()."/upload/";
        if (!is_dir($destinationPath)) {  mkdir($destinationPath,0777,true);  }
        File::put($destinationPath.$file,$data);
        return response()->download($destinationPath.$file);
	}
}