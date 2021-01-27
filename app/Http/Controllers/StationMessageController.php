<?php

namespace App\Http\Controllers;
use App\MsgFile;
use App\ChargePoint;
use App\ConnectorType;
use Illuminate\Http\Request;

class StationMessageController extends Controller
{
    public function index()
    {
      $data = MsgFile::leftJoin('chargepoint', 'msg_files.cp_id', '=', 'chargepoint.CP_ID')
              ->select('chargepoint.CP_Name', 'chargepoint.CP_Status', 'chargepoint.CP_ID','msg_files.cp_id', 'msg_files.id', 'msg_files.type', 'msg_files.file_path', 'msg_files.created_at' )
              ->orderBy('msg_files.id', 'desc')
              ->get();
        return view('pages/stationmessages/index')->with('data', $data);
    }

    public function listMsgs() {
    	$msgs = MsgFile::leftJoin('chargepoint', 'msg_files.cp_id', '=', 'chargepoint.id')
    					->select('chargepoint.CP_Name', 'chargepoint.CP_Status', 'chargepoint.CP_ID','msg_files.cp_id', 'msg_files.id', 'msg_files.type', 'msg_files.file_path', 'msg_files.created_at' )
    					->get();
        $i=1;
        foreach ($msgs as $msg) { 
            $row[] = array(
                           'id' =>$msg->id,
                           'date' =>$msg->created_at,
                           'station'=> $msg->CP_Name,
                           'type'=> $msg->CP_Status,
                       		'msg'=> "msg"
                           );

        }
        if(!empty($row)){
         $response = array(
                       "draw" => 0,
                       "recordsTotal" => count($row),
                       "recordsFiltered" => count($row),
                       "data" => $row
                     );
        }

        else {
          $response = array('data'=>'');
        }
      	echo json_encode($response);

    }

    public function cpMessages($cp_id)
    {
      //$cp_id = $id; 
        $cp = ChargePoint::where('CP_ID', '=',$cp_id )->first();
        $connector = ConnectorType::where('id', '=', $cp->CP_Connector_Type)->get();
        $msgs = MsgFile::leftJoin('chargepoint', 'msg_files.cp_id', '=', 'chargepoint.CP_ID')
              ->select('chargepoint.CP_Name', 'chargepoint.CP_Status', 'chargepoint.CP_ID','msg_files.cp_id', 'msg_files.id', 'msg_files.type', 'msg_files.file_path', 'msg_files.created_at' )
              ->where('msg_files.cp_id', '=', $cp_id)
              //->where('msg_files.type', '=', 1)
              ->orderBy('msg_files.id', 'desc')
              ->get();
      return view('pages/stationmessages/cp_msgs', compact('cp', 'msgs', 'connector'));
    }
    


}
