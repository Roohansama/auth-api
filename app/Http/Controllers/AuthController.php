<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return response()->json(["success" => true, "message" => "User created successfully"], 200);
    }

    public function login(Request $request){
        try{
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $credentials = $request->only('email', 'password');

            if(!$token = JWTAuth::attempt($credentials)){
                return response()->json(["success" => false, "message" => "Invalid Credentials"], 401);
            }

            return response()->json(['token' => $token]);
        }catch(JWTException $e){
            return response()->json(["success" => false, "message" => $e->getMessage()], 500);
        }
    }

    public function logout(Request $request){

        JWTAuth::invalidate(JWTAuth::getToken());
        return response()->json(["success" => true, "message" => "Logged out successfully"], 200);
    }

    public function me(){
        try{
            return response()->json(JWTAuth::User());
        }catch(\Tymon\JWTAuth\Exceptions\JWTException $e){
            return response()->json(["success" => false, "message" => $e->getMessage()]);
        }

    }
}
