<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChargingActivity extends Model
{
	use SoftDeletes;
	protected $table = 'charging_activities';
    protected $guarded = ['id'];
    public function user(){
    	return $this->belongsTo(User::class);
    }
}
