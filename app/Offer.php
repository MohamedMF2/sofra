<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model 
{

    protected $table = 'offers';
    public $timestamps = true;
    protected $fillable = array('restaurant_id', 'image', 'name', 'description', 'start', 'end');

    public function restaurant()
    {
        return $this->belongsTo('App\Restaurant');
    }

}