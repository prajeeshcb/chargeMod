<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\HeartBeat;
use App\Message;
use Session;

class ConnectionController extends Controller
{
    public function fetchPayloads() {
    	$json[] = Session::get('payload.data');
    	return $json;
    }

    public function heartbeat(Request $request) {
    	if($request->MessageTypeId==2) 
        {
        	$UniqueId = $request->UniqueId;
        	$message = new Message();
			$message['UniqueId'] = $UniqueId;
            $message['messageTypeId'] = 3;

        	$res= [
                'MessageTypeId' => $message->messageTypeId,
                'UniqueId' => $message->UniqueId,
                'data' => [
                   
                        ], 
                    ];
            
        	broadcast(new HeartBeat($message))->toOthers();
    		return json_encode($res);
        }


    }
}
