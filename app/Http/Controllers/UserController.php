<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class UserController extends Controller
{
    public function index()
    {
        $data=User::all();
        return view('pages/User/index')->with('data', $data);
    }
    public function create()
    {
        return view('pages/User/create');
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'User_Type'=>'required',
            'User_Name'=>'required',
            'User_Mobile'=>'required',
            'Username'=>'required',
            'User_Password'=>'required',
            'User_Address'=>'required',
            'User_Pin'=>'required',
            'User_State'=>'required',
            'User_District'=>'required',
        ]);
        $data=new User();
        $data->User_Type=$request->User_Type;
        $data->User_Name=$request->User_Name;
        $data->User_Mobile=$request->User_Mobile;
        $data->Username=$request->Username;
        $data->User_Password=bcrypt($request->User_Password);
        $data->User_Address=$request->User_Address;
        $data->User_Pin=$request->User_Pin;
        $data->User_State=$request->User_State;
        $data->User_District=$request->User_District;
        $data->Status="Active";
        $data->save();
        return redirect('/user');
    }
    public function show($id)
    {
        $data=User::where('User_ID',$id)->first();
        return view('pages/User/edit',compact('data'));
    }
    public function update(Request $request,$id)
    {
        $validated_data=$this->validate($request,[
            'User_Type'=>'',
            'User_Name'=>'',
            'User_Mobile'=>'',
            'Username'=>'',
            'User_Password'=>'',
            'User_Address'=>'',
            'User_Pin'=>'',
            'User_State'=>'',
            'User_District'=>'',
        ]);
        User::where('User_ID',$id)->update($validated_data);
        return redirect('/user');
    }
    public function deactivate($id)
    {
        User::where('User_ID', $id)->update(array('Status' => 'Deactive'));
        return redirect('/user');
    }
}
