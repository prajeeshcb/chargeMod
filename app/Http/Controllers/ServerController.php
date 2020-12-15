<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ChargePoint;

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
    	$cp = ChargePoint::leftjoin('connector_type','charge_point.connector_type', '=','connector_type.connector_Id',)
    						->leftjoin('charging_stations', 'charge_point.station_id', '=', 'charging_stations.station_Id')
    						->select('charge_point.charge_point_vendor', 'connector_type.connector_Name', 'charge_point.id', 'charge_point.status', 'charging_stations.station_Name')
                    		->where('charge_point.station_id',$station)
                    		->where('charge_point.id',$cp)
                    		->first();
        return $cp;
    }
}
