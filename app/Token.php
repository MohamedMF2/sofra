<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Token extends Model 
{

    protected $table = 'tokens';
    public $timestamps = true;
    protected $fillable = array('tokenable_type', 'platform', 'token');

    public function tokenable()
    {
        return $this->morphTo();
    }

}