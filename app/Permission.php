<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;

class Permission extends \Spatie\Permission\Models\Permission
{
    protected $fillable = ['route','guard_name','name'] ;
}
