<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Energy_Details extends Model
{
    protected $table='Energy_Details';
    protected $fillable=['ID','Energy_Unit','Total_Unit','Energy_Provider','Date','Unit_Price'];
}
