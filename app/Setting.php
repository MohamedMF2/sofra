<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model 
{

    protected $table = 'settings';
    public $timestamps = true;
    protected $fillable = array('about', 'elahly_bank', 'alrajhi_bank', 'commission_details', 'email', 'phone', 'facebook', 'instagram', 'twitter', 'linkedin', 'youtube', 'google', 'whatsapp');
    
}