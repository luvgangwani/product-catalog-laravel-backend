<?php

namespace App\Observers;

use App\Users;
use App\UsersRoles;
use Illuminate\Database\QueryException;

class UsersObserver
{
    /**
     * Handle the users "created" event.
     *
     * @param  \App\Users  $users
     * @return void
     */
    public function created(Users $users)
    {
        //

        // setting a new users' role to User by default on creation
        
        if (isset($users->id)) {

            $newUserRole = new UsersRoles();

            $newUserRole->user_id = $users->id;
            $newUserRole->role_id = config('enums.role.USER');

            try {
                $newUserRole->save();
            } catch (QueryException $e) {
                return response()->json(array(
                    'success' => false,
                    'message' => 'Error setting roles! Error: '.$e->getMessage()
                ));
            }

        }
    }

    /**
     * Handle the users "updated" event.
     *
     * @param  \App\Users  $users
     * @return void
     */
    public function updated(Users $users)
    {
        //
    }

    /**
     * Handle the users "deleted" event.
     *
     * @param  \App\Users  $users
     * @return void
     */
    public function deleted(Users $users)
    {
        //
    }

    /**
     * Handle the users "restored" event.
     *
     * @param  \App\Users  $users
     * @return void
     */
    public function restored(Users $users)
    {
        //
    }

    /**
     * Handle the users "force deleted" event.
     *
     * @param  \App\Users  $users
     * @return void
     */
    public function forceDeleted(Users $users)
    {
        //
    }
}
