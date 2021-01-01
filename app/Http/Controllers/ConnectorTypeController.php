<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ConnectorType;
class ConnectorTypeController extends Controller
{
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
        $data=new ConnectorType();
        $data->Type=$request->Type;
        $data->Remarks=$request->Remarks;
        $data->save();
        return redirect('/connector');

    }
}
