<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\HeartBeat;
use App\Message;
use Session;
use File;
class ConnectionController extends Controller
{
    /*public function fetchPayloads() {
    	$json[] = Session::get('payload.data');
    	return $json;
    }*/

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
    public function JSONheartbeat()
    {
        $data = json_encode(['{"MessageTypeId":"2","UniqueId":"334741","Action":"Heartbeat","data":[]']);
        $file = time() .rand(). '_file.json';
        $destinationPath=public_path()."/upload/";
        if (!is_dir($destinationPath)) {  mkdir($destinationPath,0777,true);  }
        File::put($destinationPath.$file,$data);
        return response()->download($destinationPath.$file);
    }
    public function JSONheartbeatres()
    {
        $data = json_encode(['{"MessageTypeId":"3","UniqueId":"334741","Action":"HeartbeatResponse","currentTime": "2013-02-01T15:09:18Z"']);
        $file = time() .rand(). '_file.json';
        $destinationPath=public_path()."/upload/";
        if (!is_dir($destinationPath)) {  mkdir($destinationPath,0777,true);  }
        File::put($destinationPath.$file,$data);
        return response()->download($destinationPath.$file);
    }
}
