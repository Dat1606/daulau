<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'user_rooms');
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'user_groups' );
    }

    public function userGroups() 
    {
       return $this->hasMany(UserGroup::class);
    }

    public function groupConsumptions() 
    {
       return $this->hasMany(GroupConsumption::class, 'user_id');
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
