<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    //
    public function users()
    {
        return $this->belongsToMany('App\Users', 'users_roles', 'user_id', 'role_id');
    }
}
