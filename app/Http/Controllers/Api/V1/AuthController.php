<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Users;
use App\UsersRoles;
use Hash;
use Illuminate\Database\QueryException;

class AuthController extends Controller
{
    //

    public function register(Request $request)
    {
        $validUser = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'email|required|unique:users',
            'username' => 'required|unique:users',
            'password' => 'required|confirmed'
        ]);

        $validUser['password'] = Hash::make($request->password);

        try {
            
            $returnResponse = null;

            $newUser = new Users();

            $newUser->first_name = $validUser['first_name'];
            $newUser->last_name = $validUser['last_name'];
            $newUser->email = $validUser['email'];
            $newUser->username = $validUser['username'];
            $newUser->password = $validUser['password'];

            if ($newUser->save()) {
                // insert an entry in the users_roles table for the new user with the appropriate role selected

                $newUserRole = new UsersRoles();

                $newUserRole->user_id = $newUser->id;
                $newUserRole->role_id = config('enums.role.USER'); // default role is user - TODO: Write a DB trigger instead

                if ($newUserRole->save()) {

                    $isDataSaved = true;

                }
            }

            if ($isDataSaved) {

                $accessToken = $newUser->createToken(env('PASSPORT_TOKEN'))->accessToken;

                $returnResponse = response()->json(array(
                    'success' => true,
                    'message' => 'Registration successful!',
                    'access_token' => $accessToken
                ), 200);
            }
            else {
                $returnResponse = response()->json(array(
                    'success' => false,
                    'message' => 'Registration unsuccessful!'
                ), 400);
            }

            return $returnResponse;

        } catch (QueryException $e) {
            //throw $th;

            return response()->json(array(
                'success' => false,
                'message' => 'Registration unsuccessful! Error: '.$e->getMessage()
            ), 500);
        }
    }

    public function login(Request $request)
    {

        $returnResponse = null;

        $validLoignInput = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (auth()->attempt($validLoignInput)) {

            $user = auth()->user();

            $accessToken = $user->createToken(env('PASSPORT_TOKEN'))->accessToken;
            
            $returnResponse = response()->json(array(
                'success' => true,
                'message' => 'Login successful!',
                'user' => $user,
                'access_token' => $accessToken
            ), 200);
        }
        else {
            $returnResponse = response()->json(array(
                'success' => false,
                'message' => 'Login unsuccessful. Please try again!'
            ), 400);
        }

        return $returnResponse;
    }
}
