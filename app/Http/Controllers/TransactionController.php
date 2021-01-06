<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
class TransactionController extends Controller
{
  public function index()
  {
    $data=Transaction::all();
    return view('pages/transaction/index')->with('data',$data);
  }
  public function create()
  {
    return view('pages/transaction/create');
  }
  public function store(Request $request)
  {
    $this->validate($request,[
        'Connector_ID'=>'required',
        'CP_ID'=>'required',
        'CS_ID'=>'required',
        'User_ID'=>'required',
        'Reservation_ID'=>'required',
        'Trans_DateTime'=>'required',
        'Trans_Meter_Start'=>'required',
        'Trans_Meter_Stop'=>'required'
        ]);
      $data=new Transaction();
      $data->Connector_ID=$request->Connector_ID;
      $data->CP_ID=$request->CP_ID;
      $data->CS_ID=$request->CS_ID;
      $data->User_ID=$request->User_ID;
      $data->Reservation_ID=$request->Reservation_ID;
      $data->Trans_DateTime=$request->Trans_DateTime;
      $data->Trans_Meter_Start=$request->Trans_Meter_Start;
      $data->Trans_Meter_Stop=$request->Trans_Meter_Stop;
      $data->save();
      return redirect('/transaction');
  }
  public function show($id)
  {
    $data=Transaction::findorfail($id);
    return view('pages/transaction/edit',compact('data'));
  }
  public function update(Request $request,$id)
  {
      $validated_data=$this->validate($request,[
        'Connector_ID'=>'',
        'CP_ID'=>'',
        'CS_ID'=>'',
        'User_ID'=>'',
        'Reservation_ID'=>'',
        'Trans_DateTime'=>'',
        'Trans_Meter_Start'=>'',
        'Trans_Meter_Stop'=>''
        ]);
        Transaction::whereId($id)->update($validated_data);
        return redirect('/transaction');
  }
  public function destroy($id)
  {
    $data=Transaction::findorFail($id)->delete();
    return redirect('/transaction');
  }
}
