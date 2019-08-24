<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model 
{

    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = array('district_id', 'name', 'email', 'phone','pin_code','password');
/**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password','api_token','pin_code'];   
     public function contacts()
    {
        return $this->morphMany('App\Contact','contactable');
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    // public function restaurants()
    // {
    //     return $this->belongsToMany('App\Restaurant');
    // }

    public function notifications()
    {
        return $this->morphMany('App\Notification','notifiable');
    }

    public function tokens()
    {
        return $this->morphMany('App\Token', 'tokenable');
    }

    public function district()
    {
        return $this->belongsTo('App\District');
    }
    public function reviews(){
        return $this->hasMany('App\Review');

    }

}