<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model 
{

    protected $table = 'districts';
    public $timestamps = true;
    protected $fillable = array('city_id', 'name');

    public function city()
    {
        return $this->belongsTo('App\City');
    }

    public function clients()
    {
        return $this->hasMany('App\Client');
    }

    public function restaurants()
    {
        return $this->hasMany('App\Restaurant');
    }

}