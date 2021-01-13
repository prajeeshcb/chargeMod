<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ChargePoint;
class ChargePointController extends Controller
{
    
    public function index()
    {
        $data=ChargePoint::all();
        return view('pages/chargepoints/index')->with('data', $data);
    }
    public function create()
    {
        return view('pages/chargepoints/create');
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'CP_Name'=>'required',
            'CP_State'=>'required',
            'CP_District'=>'required',
            'CP_Loc'=>'required',
            'CP_Connector_Type'=>'required',
            'CB_Serial_No'=>'required',
            'CP_Serial_No'=>'required',
            'CP_Firmware_Ver'=>'required',
            'CP_Meter_Serial_No'=>'required',
            'CP_Meter_Type'=>'required',
            'Station_Phone'=>'required',
            'Station_Email'=>'required',
            'CP_Status'=>'required'
        ]);
        $data=new ChargePoint();
        $data->CP_Name=$request->CP_Name;
        $data->CP_State=$request->CP_State;
        $data->CP_District=$request->CP_District;
        $data->CP_Loc=$request->CP_Loc;
        $data->CP_Connector_Type=$request->CP_Connector_Type;
        $data->CB_Serial_No=$request->CB_Serial_No;
        $data->CP_Serial_No=$request->CP_Serial_No;
        $data->CP_Firmware_Ver=$request->CP_Firmware_Ver;
        $data->CP_Meter_Serial_No=$request->CP_Meter_Serial_No;
        $data->CP_Meter_Type=$request->CP_Meter_Type;
        $data->Station_Phone=$request->Station_Phone;
        $data->Station_Email=$request->Station_Email;
        $data->CP_Status=$request->CP_Status;
        $data->save();
        return redirect('/CP');
    }
    public function show($id)
    {
        $data=ChargePoint::where('CP_ID',$id)->first();
        return view('pages/chargepoints/edit',compact('data'));
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
      return redirect('/CP');
    }
    public function destroy($id)
    {
        $data=ChargePoint::where('CP_ID',$id)->first();
        $data->delete();
        return redirect('/CP');
    }
}
