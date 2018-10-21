<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phone_number extends Model
{
    //
    public function user()
    {
        return $this->belongsTo('App/User');
    }
}
