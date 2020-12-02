<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StopTransactionController extends Controller
{
    
    public function stop() {
    	if($request->MessageTypeId==2) 
        {
        	return $request;
        }
    }
}
