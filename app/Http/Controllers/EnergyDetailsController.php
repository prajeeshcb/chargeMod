<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Energy_Detail;
class EnergyDetailsController extends Controller
{
    public function index()
    {
        $data=Energy_Detail::all();
        return view('pages/energydetails/index')->with('data', $data);
    }
    public function create()
    {
        return view('pages/energydetails/create');
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'Energy_Unit'=>'required',
            'Total_Unit'=>'required',
            'Energy_Provider'=>'required',
            'Date'=>'required',
            'Unit_Price'=>'required'
        ]);
        $data=new Energy_Detail();
        $data->Energy_Unit=$request->Energy_Unit;
        $data->Total_Unit=$request->Total_Unit;
        $data->Energy_Provider=$request->Energy_Provider;
        $data->Date=$request->Date;
        $data->Unit_Price=$request->Unit_Price;
        $data->save();
        return redirect('/energydetails');
    }
    public function show($id)
    {
        $data=Energy_Detail::findorfail($id);
        return view('pages/energydetails/edit',compact('data'));
    }
    public function update(Request $request,$id)
    {
        $validated_data= $this->validate($request,[
            'Energy_Unit'=>'',
            'Total_Unit'=>'',
            'Energy_Provider'=>'',
            'Date'=>'',
            'Unit_Price'=>'',
        ]);
        Energy_Detail::whereId($id)->update($validated_data);
        return redirect('/energydetails');
    }
    public function destroy($id)
    {
        $data=Energy_Detail::findorfail($id)->delete();
        return redirect('/energydetails');
    }
}
