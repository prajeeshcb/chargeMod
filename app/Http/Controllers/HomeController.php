<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use App\ChargingStation;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function JSONauthreq(){
        $data = json_encode(['{"MessageTypeId":"2","UniqueId":"456378","Action":"Authorize","idTag":"567890"}']);
        $file = time() .rand(). '_file.json';
        $destinationPath=public_path()."/upload/";
        if (!is_dir($destinationPath)) {  mkdir($destinationPath,0777,true);  }
        File::put($destinationPath.$file,$data);
        return response()->download($destinationPath.$file);

	  }
	
    public function JSONauthres()
      {
        $data = json_encode(['{"MessageTypeId":"3","UniqueId":"456378","Action":"AuthorizeResponse","IdTagInfo":{"status":"Accepted","expiryDate":"2021-3-8T3.00PM","parentIdtag":"567890"}}']);
        $file = time() .rand(). '_file.json';
        $destinationPath=public_path()."/upload/";
        if (!is_dir($destinationPath)) {  mkdir($destinationPath,0777,true);  }
        File::put($destinationPath.$file,$data);
        return response()->download($destinationPath.$file);
      }

   /* public function authentication()
    {
        return view('profile');
    }
    public function connection()
    {
        return view('chats');
    }*/
    public function test(Request $request)
    {
        $test=$request->Type;
        console.log($test);
    }
}

