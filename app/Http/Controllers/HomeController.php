<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use App\ChargePoint;
use App\Customers;
use App\ConnectorType;
use App\CPConnector;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*public function __construct()
    {
        $this->middleware('auth');
    }*/

    public function getChargepoints()
    {
        $chargepoints=ChargePoint::get();

        return response()->json($chargepoints);
    } 
    public function getConnectors(Request $request)
    {
        $connectors = CPConnector::leftJoin('connectortype','cp_connector.connector_type', '=', 'connectortype.id')
                            ->select('connectortype.id','connectortype.Type')
                            ->where('cp_id', $request->cp_id)
                            ->get();

        return response()->json($connectors);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $charge_points = ChargePoint::all();
        $customers = Customers::all();
        return view('pages.dashboards.index', compact('charge_points', 'customers'));
    }
    

   /* public function authentication()
    {
        return view('profile');
    }
    public function connection()
    {
        return view('chats');
    }*/
  
}

