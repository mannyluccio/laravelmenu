<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use App\Utils\Common;
use Illuminate\Http\Request;

use JWTAuth;
use \Validator;



class AuthController extends Controller
{

    public function register(Request $r)
    {
        $validation = Validator::make($r->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required'
        ]);

        if ($validation->fails()) {
            return Common::response(false, '', $validation->errors(), 400);
        }

        $user = new User();
        $user->first_name = $r->first_name;
        $user->last_name = $r->last_name;
        $user->email = $r->email;
        $user->password = bcrypt($r->password);
        $user->save();

        return Common::response(true, $user);

    }

    public function login(Request $request)
    {
        $input = $request->only('email', 'password');
        $jwt_token = null;

        if (!$jwt_token = JWTAuth::attempt($input)) {
            return Common::response(false, '','Invalid Email or Password',401);
        }

        $user = JWTAuth::user();
        $user->token = $jwt_token;
        $user->save();

        return Common::response(true, ['token' => $jwt_token]);
    }


}
