<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    //
    public function group_consumptions()
    {
        return $this->hasMany('App/GroupConsumption');
    }
}
