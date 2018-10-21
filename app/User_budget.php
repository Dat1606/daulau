<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_budget extends Model
{
    //
    public function user()
    {
        return $this->belongsTo('App/User');
    }

    public function user_consumptions()
    {
        return $this->hasMany('App/User_consumption');
    }
}
