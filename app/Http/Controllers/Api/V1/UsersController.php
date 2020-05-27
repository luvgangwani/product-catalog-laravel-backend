<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Users;
use App\UsersRoles;
use App\Http\Resources\Users as UsersResource;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Hash;
use Auth;

class UsersController extends Controller
{
    //

    public function index() {

        return response()->json(array(
            'success' => true,
            'message' => '',
            'data' => Users::all()
        ), 200);
    }
    
    public function getUserById(Request $request)
    {

        try {
            return response()->json(array(
                        'success' => true,
                        'message' => '',
                        'data' => new UsersResource(Users::find(auth()->user()->id))
                    ), 200);
        } catch(QueryException $e) {

            return response()->json(array(
                        'success' => false,
                        'message' => 'Error loading user data!',
                    ), 400);

        }
    }

    public function getUserByUsername(Request $request) {
        return response()->json(array(
            'success' => true,
            'message' => '',
            'data'=> Users::where('username', auth()->user()->username)->get()
        ), 200);
    }
}
