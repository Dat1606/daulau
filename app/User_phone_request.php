<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_phone_request extends Model
{
    //
    public function user()
    {
        return $this->belongsTo('App/User');
    }

    public function room()
    {
        return $this->belongsTo('App/Room');
    }
}
