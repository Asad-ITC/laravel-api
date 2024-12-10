<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserAuthController extends Controller
{
    //
    function login(Request $request)
    {
        
    }

    function signup(Request $request) {
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->plainTextToken;
        $success['name'] =  $user->name;
        return ['status' => 'success', 'data' => $success, "msg" => "User register successfully."];
    }
}
