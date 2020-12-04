<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Heartbeat;
class HeartbeatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function heartBeats(){
     
            $heartbeats=new Heartbeat();
            $heartbeats->message=$request['data']['message'];
            $heartbeats->save();
            broadcast(new Heartbeat($heartbeats))->toOthers(); 
            // return response()->json($beats);
    }
}
