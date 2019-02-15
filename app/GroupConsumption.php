<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupConsumption extends Model
{
    //
    public function group()
    {
      return  $this->belongsTo('App/Group');
    }

    public function user()
    {
      return  $this->belongsTo(User::class, 'user_id');
    }

    public function creator()
    {
    	return $this->belongsTo(User::class, 'creator_id');
    }
}
