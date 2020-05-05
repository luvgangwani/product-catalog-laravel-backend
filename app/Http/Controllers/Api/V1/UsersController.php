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
}
