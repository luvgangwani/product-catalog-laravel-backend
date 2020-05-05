<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Laravel\Passport\HasApiTokens;

class Users extends Authenticatable
{
    //

    use HasApiTokens, Notifiable;

    public function roles()
    {
        return $this->belongsToMany('App\Roles', 'users_roles', 'user_id', 'role_id');
    }
}
