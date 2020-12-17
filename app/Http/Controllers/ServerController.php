<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ChargePoint;
use App\ChargingActivity;
use Carbon\Carbon;
use App\Events\RemoteStartTransaction;
use App\Events\RemoteStopTransaction;
use Session;
use File;
class ServerController extends Controller
{
    public function index() {
    	return view('server');
    }

    public function ChargePoints($station) {
    	$cp = ChargePoint::leftjoin('connector_type','charge_point.connector_type', '=','connector_type.connector_Id')
    						->select('charge_point.charge_point_vendor', 'connector_type.connector_Name', 'charge_point.id')
                    		->where('charge_point.station_id',$station)
                    		->get();
        return $cp;

    }

    public function ChargePointInfo($station, $cp) {
    	$cp = ChargePoint::leftjoin('connector_type','charge_point.connector_type', '=','connector_type.connector_Id')
    						->leftjoin('charging_stations', 'charge_point.station_id', '=', 'charging_stations.station_Id')
    						->select('charge_point.charge_point_vendor', 'connector_type.connector_Name', 'charge_point.id', 'charge_point.status', 'charging_stations.station_Name')
                    		->where('charge_point.station_id',$station)
                    		->where('charge_point.id',$cp)
                    		->first();
        return $cp;
    }

    public function remoteStart(Request $request) {
        if($request->MessageTypeId==2) 
        {
            $charging = new ChargingActivity();
            $charging->vehicle_tag_id = $request['data']['idTag'];
            $charging->user_id= 2;
            $charging->station_id = 1;
            $charging->meter_start_reading = 4443;
            $charging->reservation_id = 0;
            $charging->connector_id = $request['data']['connectorId'];
            $charging->status = 1;// charging started
            $charging->started_at = Carbon::now();
            $charging->save();

            $transactionId = $charging->id;
            $UniqueId = $request->UniqueId;

            Session::put('transactionId', $transactionId);
            Session::put('idTag', $request['data']['idTag']);
            $chargingActivity = ChargingActivity::select('charging_activities.id as id')
                ->where('charging_activities.id', $transactionId)->first();
            $chargingActivity['UniqueId'] = $UniqueId;
            $chargingActivity['messageTypeId'] = 3;
            $chargingActivity['status']="Accepted";

            $res= [
                'messageTypeId' => 3,
                'UniqueId' =>$UniqueId,
                'data' => [
                      'transactionId' => $chargingActivity->id,
                      'status' =>"Accepted"
                    ]
                ];
            broadcast(new RemoteStartTransaction($chargingActivity))->toOthers();
            return $res;
        }
    }

    public function remoteStop(Request $request) {
        if($request->MessageTypeId==2 ) 
        {
            $transactionId = $request['data']['transactionId'];
            $charging_activity = ChargingActivity::find($transactionId);
            $charging_activity->meter_end_reading = '9999';
            $charging_activity->stopped_at = Carbon::now();
            $charging_activity->status = 2; //charging stoped
            $charging_activity->save();

            $chargingActivity = ChargingActivity::select('charging_activities.status', 'charging_activities.id as id')
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
                    'data' =>[
                            'transactionId' => $chargingActivity->id,
                             'status' => "Accepted",
                            ], 
                    ];
          
            broadcast(new RemoteStopTransaction($chargingActivity))->toOthers();
            $request->session()->forget($transactionId);
            return $res;
        }
    }
    public function JSONstartreq()
    {
        $data = json_encode(['{MessageTypeId:2,UniqueId:466879,Action:RemoteStartTransacion,connectorId:11111,idTag:567890,chargingProfile:{chargingProfileId:2546,transactionId:456,stackLevel:18,chargingProfilePurpose:TxProfile,chargingProfileKind:Absolute,recurrencyKind:Daily,validFrom:8-12-201511.30AM,validTo:8-12-201511.30AM,chargingSchedule:{duration:40min,startSchedule:17-12-202010.30AM,chargingRateUnit:W,chargingSchedulePeriod{startPeriod:10,limit:9.1,numberPhases:2},minChargingRate:10.1}}}']);
        $file = time() .rand(). '_file.json';
        $destinationPath=public_path()."/upload/";
        if (!is_dir($destinationPath)) {  mkdir($destinationPath,0777,true);  }
        File::put($destinationPath.$file,$data);
        return response()->download($destinationPath.$file);
    }
    public function JSONstartres()
    {
        $data = json_encode(['{MessageTypeId:3,UniqueId:466879,status:Accepted}']);
        $file = time() .rand(). '_file.json';
        $destinationPath=public_path()."/upload/";
        if (!is_dir($destinationPath)) {  mkdir($destinationPath,0777,true);  }
        File::put($destinationPath.$file,$data);
        return response()->download($destinationPath.$file);
    }
    public function JSONstopreq()
    {
        $data = json_encode(['{MessageTypeId:2,UniqueId:567699,Action:RemoteStopTransaction,transcationId:456}']);
        $file = time() .rand(). '_file.json';
        $destinationPath=public_path()."/upload/";
        if (!is_dir($destinationPath)) {  mkdir($destinationPath,0777,true);  }
        File::put($destinationPath.$file,$data);
        return response()->download($destinationPath.$file);
    }
    public function JSONstopres()
    {
        $data = json_encode(['{MessageTypeId:3,UniqueId:567699,status:Accepted}']);
        $file = time() .rand(). '_file.json';
        $destinationPath=public_path()."/upload/";
        if (!is_dir($destinationPath)) {  mkdir($destinationPath,0777,true);  }
        File::put($destinationPath.$file,$data);
        return response()->download($destinationPath.$file);
    }
}
