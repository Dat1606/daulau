<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    protected $table = 'user_groups';

    public function user()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }

    public function group()
    {
    	return $this->belongsTo(Group::class, 'group_id');
    }
}
