<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    protected $table = 'user_groups';

    public function users()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }
}