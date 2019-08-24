<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model 
{

    protected $table = 'payments';
    public $timestamps = true;
    protected $fillable = array('restaurant_id', 'paid', 'remaining', 'commissions','notes');

    public function restaurant()
    {
        return $this->belongsTo('App\Restaurant');
    }

}