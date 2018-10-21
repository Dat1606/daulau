<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class room extends Model
{
    //
    public function user_requests()
    {
        return $this->belongsToMany('App/User','user_id','room_id' , 'user_requests');
    }

    public function user_phone_requests()
    {
        return $this->belongsToMany('App/User','user_id','room_id','user_phone_requests');
    }

    public function users()
    {
        return $this->belongsToMany('App/User','user_id','room_id','user_rooms');
    }
}
