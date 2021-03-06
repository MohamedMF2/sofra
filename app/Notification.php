<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model 
{

    protected $table = 'notifications';
    public $timestamps = true;
    protected $fillable = array('title', 'body', 'notifiable_id', 'notifiable_type','order_id','is_read');

    public function notifiable()
    {
        return $this->morphTo();
    }

    public function order(){
        return $this ->belongsTo('App\Order');
    }
}