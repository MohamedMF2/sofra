<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model 
{

    protected $table = 'orders';
    public $timestamps = true;
    protected $fillable = array('client_id', 'address', 'notes','total', 'cost', 'payment', 'status', 'commission','phone','restaurant_id');

    public function products()
    {
        return $this->belongsToMany('App\Product')->withPivot('price','quantity','special_order');
    }

    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public function restaurant()
    {
        return $this->belongsTo('App\Restaurant');
    }

    public function notifications(){
        return $this ->hasMany('App\Notification');
    }

}