<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    use Notifiable;
    // use SoftDeletes;

    //   @var array
     
    protected $table='customers';
    protected $primaryKey='User_ID';
   // protected $primaryKey='User_ID';
    protected $fillable = ['User_Type','User_Name','User_Mobile','Username','User_Password','User_Address','User_Pin','User_State','User_District','Status'];
    // protected $dates = ['deleted_at'];


    //  
    //  @var array
    //  
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function messages(){
        return $this->hasMany(Message::class);
    }
}
