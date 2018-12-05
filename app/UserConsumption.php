<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserConsumption extends Model
{
    //
    public function user_budget() 
    {
        return $this->belongsTo('App/UserBudget');
    }
}
