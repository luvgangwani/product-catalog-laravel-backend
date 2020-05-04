<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Users;
use App\UsersRoles;
use App\Http\Resources\Users as UsersResource;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Hash;

class UsersController extends Controller
{
    //

    public function index() {
        return response()->json(Users::all(), 200);
    }
    
    public function getUserById(Request $request)
    {
        return response()->json(Users::find($request->id), 200);
    }

    public function getUserByUsername(Request $request) {
        return response()->json(Users::where('username', $request->username)->get(), 200);
    }

    public function register(Request $request)
    {
        try {
            $returnResponse = null;

            $isDataSaved = false;

            $newUser = new Users();

            $newUser->first_name = $request->first_name;
            $newUser->last_name = $request->last_name;
            $newUser->email = $request->email;
            $newUser->username = $request->username;
            $newUser->password = Hash::make($request->password);

            if ($newUser->save()) {
                // insert an entry in the users_roles table for the new user with the appropriate role selected

                $newUserRole = new UsersRoles();

                $newUserRole->user_id = $newUser->id;
                $newUserRole->role_id = $request->role_id;

                if ($newUserRole->save()) {

                    $isDataSaved = true;

                }
            }

            if ($isDataSaved) {
                $returnResponse = response()->json(array('success' => true, 'message' => 'Registration successful!'), 200);
            }
            else {
                $returnResponse = response()->json(array('success' => false, 'message' => 'Registration unsuccessful!'), 500);
            }

            return $returnResponse;
        } catch(QueryException $e) {
            return response()->json(array('success' => false, 'message' => 'Registration unsuccessful! Error: '.$e->getMessage()), 500);
        }

    }
}
