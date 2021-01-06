<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Energy_Detail extends Model
{
    protected $fillable=['Energy_Unit','Total_Unit','Energy_Provider','Date','Unit_Price'];
}
