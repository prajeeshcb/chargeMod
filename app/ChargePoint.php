<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChargePoint extends Model
{
    protected $table='chargepoint';
    protected $primaryKey='CP_ID';
    protected $fillable=['CP_Name','CP_State','CP_District','CP_Loc','CP_Connector_Type','CB_Serial_No','CP_Serial_No','CP_Firmware_Ver','CP_Meter_Serial_No','CP_Meter_Type','Station_Phone','Station_Email','CP_Status'];
   
}
