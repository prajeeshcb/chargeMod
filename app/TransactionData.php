<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionData extends Model
{
    protected $table = 'transaction_data';
    protected $guarded = ['id'];
    public function transaction_id(){
    	return $this->belongsTo(ChargingActivity::class);
    }
}
