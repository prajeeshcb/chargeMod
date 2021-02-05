<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ChargePoint;
use App\MMsgFile;
use App\ConnectorType;
use App\CPConnector;
class ChargePointController extends Controller
{
    
    public function index()
    {
        $data=ChargePoint::all();
        return view('pages/chargepoints/index')->with('data', $data);
    }
    public function create()
    {
        $connector = ConnectorType::get();
        return view('pages/chargepoints/create', compact('connector'));
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'CP_Name'=>'required',
            'CP_State'=>'required',
            'CP_District'=>'required',
            'CP_Loc'=>'required',
            //'CP_Connector_Type'=>'required',
            'CB_Serial_No'=>'required',
            'CP_Serial_No'=>'required',
            'CP_Firmware_Ver'=>'required',
            'CP_Meter_Serial_No'=>'required',
            'CP_Meter_Type'=>'required',
            'Station_Phone'=>'required',
            'Station_Email'=>'required' 
        ]);
        $chargepoint=new ChargePoint();
        $chargepoint->CP_Name=$request->CP_Name;
        $chargepoint->CP_State=$request->CP_State;
        $chargepoint->CP_District=$request->CP_District;
        $chargepoint->CP_Loc=$request->CP_Loc;
        //$data->CP_Connector_Type=$request->CP_Connector_Type;
        $chargepoint->CB_Serial_No=$request->CB_Serial_No;
        $chargepoint->CP_Serial_No=$request->CP_Serial_No;
        $chargepoint->CP_Firmware_Ver=$request->CP_Firmware_Ver;
        $chargepoint->CP_Meter_Serial_No=$request->CP_Meter_Serial_No;
        $chargepoint->CP_Meter_Type=$request->CP_Meter_Type;
        $chargepoint->Station_Phone=$request->Station_Phone;
        $chargepoint->Station_Email=$request->Station_Email;
        //$chargepoint->CP_Status="0";
        $chargepoint->save();

        if ($request->has('charging_pin_id')) {
            for ($x = 0; $x < count($request->charging_pin_id); $x++) {
                $store = ['connector_type' => $request->charging_pin_id[$x],
                    'cp_id' => $chargepoint->CP_ID,
                    //'relay_switch_number' => $request->relay_switch_number[$x],
                    'status' => 0 
                ];
                CPConnector::create($store);
            }
        }
        return redirect('/CP')->with('success','Added Successfully');;
    }
    public function show($id)
    {
        $data=ChargePoint::where('CP_ID',$id)->first();
        $connector = ConnectorType::get();
        return view('pages/chargepoints/edit',compact('data', 'connector'));
    }
    public function update(Request $request,$id)
    {
        $data=ChargePoint::where('CP_ID',$id)->first();
        $validated_data= $this->validate($request,[
            'CP_Name'=>'',
            'CP_State'=>'',
            'CP_District'=>'',
            'CP_Loc'=>'',
            'CP_Connector_Type'=>'',
            'CB_Serial_No'=>'',
            'CP_Serial_No'=>'',
            'CP_Firmware_Ver'=>'',
            'CP_Meter_Serial_No'=>'',
            'CP_Meter_Type'=>'',
            'Station_Phone'=>'',
            'Station_Email'=>'',
            'CP_Status'=>''
        ]);
      ChargePoint::where('CP_ID',$id)->update($validated_data);
      return redirect('/CP')->with('success','Updated Successfully');;
    }
    public function destroy($id)
    {
        $data=ChargePoint::where('CP_ID',$id)->first();
        $data->delete();
        return redirect('/CP')->with('success','Deleted Successfully');;
    }
    public function details($id)
    {
        $data=ChargePoint::with('getconnector')->where('CP_ID',$id)->first();
        $connector = CPConnector::leftJoin('connectortype','connectortype.id', '=', 'cp_connector.connector_type')
                ->select('cp_connector.status','connectortype.Type')
                ->where('cp_id', $id)
                ->get();
        return view('pages/chargepoints/details',compact('data', 'connector'));
    }
    public function search_CP()
    {
        $search = \Request::get('search');
        $data = ChargePoint::where('CP_Name','like','%'.$search.'%')
            ->orderBy('CP_Name')
            ->paginate(20);

        return view('pages/chargepoints/index')->with('data',$data);  
    }

    
}
