<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChargingStation extends Model
{
    protected $table = 'charging_stations';
    protected $guarded = ['id'];
}
