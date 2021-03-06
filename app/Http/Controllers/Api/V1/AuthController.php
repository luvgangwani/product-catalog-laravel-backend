<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Users;
use App\UsersRoles;
use Hash;
use Illuminate\Database\QueryException;
use App\Http\Resources\Users as UsersResource;

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

                $accessToken = $newUser->createToken(env('PASSPORT_TOKEN'))->accessToken;

                $newUser['roles'] = $newUser->roles;

                $returnResponse = response()->json(array(
                    'success' => true,
                    'message' => 'Registration successful!',
                    'user' => new UsersResource($newUser),
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

            $user['roles'] = $user->roles;

            // if a non-admin tries to login to the admin console

            if (strpos($request->server('HTTP_REFERER'), 'admin') != false && $user['roles'][0]['id'] != 1) {
                $returnResponse = response()->json(array(
                    'success' => false,
                    'message' => 'Unauthorized access!'
                ), 403);
            }
            else {

                $returnResponse = response()->json(array(
                'success' => true,
                'message' => 'Login successful!',
                'user' => new UsersResource($user),
                'access_token' => $accessToken
            ), 200);

            }
        }
        else {
            $returnResponse = response()->json(array(
                'success' => false,
                'message' => 'Login unsuccessful. Please try again!'
            ), 403);
        }

        return $returnResponse;
    }
}
