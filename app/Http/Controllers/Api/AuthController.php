<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    protected function register(Request $request){
        $data = $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|confirmed',
        ]);
        $data['password'] = bcrypt($request->password);
        $user = User::create($data);
        $accessToken = $user->createToken('authToken')->accessToken;
        return response(['user'=>$user, 'token'=>$accessToken]);
    }

    protected function login(Request $request){
        $data = $request->validate([
            'email'=>'required|email',
            'password'=>'required',
        ]);
        if (!auth()->attempt($data)){
            return response(['msg'=>'Email or Password is not correct']);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;
        return response(['user'=>auth()->user(), 'token'=>$accessToken]);
    }


}
