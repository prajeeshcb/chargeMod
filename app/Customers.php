<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
class Customers extends Model
{
    
    // use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='customers';
   // protected $primaryKey='User_ID';
    protected $fillable = ['User_Type','User_Name','User_Mobile','Username','User_Password','User_Address','User_Pin','User_State','User_District','Status'];
    // protected $dates = ['deleted_at'];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */

}
