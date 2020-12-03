<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable= ['name','model','year','manufacture_id','battery','charging_time','charging_pin_id'];
}
