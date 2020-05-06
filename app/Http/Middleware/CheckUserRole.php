<?php

namespace App\Http\Middleware;

use Closure;
use App\UsersRoles;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role_id)
    {

        // get role id of the logged in user

        $logged_user_role_id = UsersRoles::where('user_id', auth()->user()->id)->first()->role_id;

        if ($logged_user_role_id != $role_id) {
            return response()->json(array(
                'success' => false,
                'message' => 'Access forbidden!'
            ), 403);
        }

        return $next($request);
    }
}
