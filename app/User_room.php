<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_room extends Model
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
