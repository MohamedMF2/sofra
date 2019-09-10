<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model 
{

    protected $table = 'restaurants';
    public $timestamps = true;
    protected $fillable = array('district_id', 'image', 'name', 'minimum_charge', 'delivery', 'phone', 'whatsapp', 'email', 'status', 'activated', 'api_token','password','pin_code');
    protected $hidden = array('password','api_token','activated',);

    public function contacts()
    {
        return $this->morphMany('App\Contact');
    }

    public function offers()
    {
        return $this->hasMany('App\Offer');
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function products()
    {
        return $this->hasMany('App\Product');
    }

    // public function clients()
    // {
    //     return $this->belongsToMany('App\Client');
    // }

    public function notifications()
    {
        return $this->morphMany('App\Notification','notifiable');
    }

    public function tokens()
    {
        return $this->morphMany('App\Token','tokenable');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

    public function district()
    {
        return $this->belongsTo('App\District');
    }

    public function payments()
    {
        return $this->hasMany('App\Payment');
    }
    public function reviews(){
        return $this->hasMany('App\Review');

    }

}