<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reservation;
class ReservationController extends Controller
{
  public function index()
  {
      $data=Reservation::all();
      return view('pages/reservations/index')->with('data',$data);
  }  
  public function create()
  {
      return view('pages/reservations/create');
  }
  public function store(Request $request)
  {
    $this->validate($request,[
      'User_ID'=>'required',
      'CS_ID'=>'required',
      'CP_ID'=>'required',
      'Connector_ID'=>'required',
      'Reserve_Date'=>'required',
      'Reserve_Time_From'=>'required',
      'Reserve_Time_End'=>'required',
      'Reservation_ID'=>'required',
      'User_Present_Loc'=>'required',    
    ]);
    $data=new Reservation();
    $data->User_ID=$request->User_ID;
    $data->CS_ID=$request->CS_ID;
    $data->CP_ID=$request->CP_ID;
    $data->Connector_ID=$request->Connector_ID;
    $data->Reserve_Date=$request->Reserve_Date;
    $data->Reserve_Time_From=$request->Reserve_Time_From;
    $data->Reserve_Time_End=$request->Reserve_Time_End;
    $data->Reservation_ID=$request->Reservation_ID;
    $data->User_Present_Loc=$request->User_Present_Loc;
    $data->save();
    return redirect('/reservation');
  }
  public function show($id)
  {
    $data=Reservation::findorfail($id);
    return view('pages/reservations/edit',compact('data'));
  }
  public function update(Request $request,$id)
  {
    $data=Reservation::findorfail($id);
    $validated_data=$this->validate($request,[
      'User_ID'=>'',
      'CS_ID'=>'',
      'CP_ID'=>'',
      'Connector_ID'=>'',
      'Reserve_Date'=>'',
      'Reserve_Time_From'=>'',
      'Reserve_Time_End'=>'',
      'Reservation_ID'=>'',
      'User_Present_Loc'=>'',    
    ]);
    Reservation::whereId($id)->update($validated_data);
    return redirect('/reservation');
  }
  public function destroy($id)
  {
    $data=Reservation::findorFail($id)->delete();
    return redirect('/reservation');
  }
}
