<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    //
    public function groupConsumptions()
    {
        return $this->hasMany(GroupConsumption::class);
    }

    public function userGroups()
    {
    	return $this->hasMany(UserGroup::class);
    }
}
