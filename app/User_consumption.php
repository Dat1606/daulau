<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_consumption extends Model
{
    //
    public function user_budget() 
    {
        return $this->belongsTo('App/User_budget');
    }
}
