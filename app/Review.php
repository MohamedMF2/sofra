<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model 
{

    protected $table = 'reviews';
    public $timestamps = true;
    protected $fillable = array('client_id', 'restaurant_id', 'rate', 'comment');

    public function client(){
        return $this->belongsTo('App\Client');

    }
    public function restaurant(){
        return $this->belongsTo('App\Restaurant');

    }
}