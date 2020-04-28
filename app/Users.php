<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    //

    public function roles()
    {
        return $this->belongsToMany('App\Roles', 'users_roles', 'user_id', 'role_id');
    }
}
