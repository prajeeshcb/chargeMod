<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MeterValue extends Model
{
    protected $table='Metervalues';
    protected $fillable=['Connector_ID','CP_ID','Date','Reservation_ID','Meter_Values'];
    
}
