<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group_consumption extends Model
{
    //
    public function group()
    {
      return  $this->belongsTo('App/Group');
    }
}
