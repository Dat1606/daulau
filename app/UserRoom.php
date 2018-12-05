<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRoom extends Model
{
    protected $table = 'user_rooms';
    
    public function user()
    {
        return $this->belongsTo('App/User');
    }

    public function room()
    {
        return $this->belongsTo('App/Room');
    }
}
