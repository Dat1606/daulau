<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserGroupRequest extends Model
{
    protected $table = 'user_group_requests';
    public function userGroup()
    {
    	return $this->belongsTo(UserGroup::class);
    }
}
