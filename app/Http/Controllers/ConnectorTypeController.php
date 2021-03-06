<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ConnectorType;
class ConnectorTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    } 
    public function index()
    {
        $data=ConnectorType::all();
        return view('pages/connector/index')->with('data', $data);
    }
    public function create()
    {
        return view('pages/connector/create');
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'Type'=>'required',
            'Remarks'=>'required'
        ]);
        $connector = str_replace(' ', '', $request->Type);
        if(ConnectorType::where('Type', $connector)->exists()){
            return redirect('/addconnector')->with('error','already exists');
        }
        else{
                $data=new ConnectorType();
                $data->Type=$request->Type;
                $data->Remarks=$request->Remarks;
                $data->save();
                return redirect('/connector')->with('success','Added Successfully');
            }

    }
    public function show($id)
    {
        $data=ConnectorType::find($id);
        return view('pages/connector/edit',compact('data'));
    }
    public function update(Request $request,$id)
    {
        $data=ConnectorType::findorfail($id);
        $validated_data=$this->validate($request,[
            'Type'=>'',
            'Remarks'=>''
        ]);
        
        ConnectorType::whereId($id)->update($validated_data);
        return redirect('/connector')->with('success','Updated Successfully');
    }
    public function destroy($id)
    {
        $data=ConnectorType::findorFail($id);
        $data->delete();
        return redirect('/connector')->with('success','Deleted Successfully');;
    }
    public function search_connector()
    {
        $search = \Request::get('search');
        $data = ConnectorType::where('Type','like','%'.$search.'%')
            ->orderBy('Type')
            ->paginate(20);

        return view('pages/connector/index')->with('data',$data);
    }
}
