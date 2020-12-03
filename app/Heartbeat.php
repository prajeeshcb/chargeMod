<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Heartbeat extends Model
{
    protected $table="heartbeats";
    protected $fillable=['message'];
}
