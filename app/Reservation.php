<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $table= 'Reservations';
    protected $fillable=['ID','User_ID','CS_ID','CP_ID','Reserve_Date','Reserve_Time_From','Reserve_Time_End','Reservation_ID','User_Present_Loc'];
}
