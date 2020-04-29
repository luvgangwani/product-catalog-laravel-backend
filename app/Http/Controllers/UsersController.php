<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Users;
use App\Http\Resources\Users as UsersResource;

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
        return response()->json(Users::where('username', $request->username)->get());
    }
}
