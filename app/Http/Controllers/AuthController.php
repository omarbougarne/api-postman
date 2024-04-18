<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){
        $data = $request->validate([
            'name' =>'required',
            'email' =>'required',
            'password' => 'required',
        ]);
        $user = User::create([
            'name' =>$data['name'],
            'email' =>$data['email'],
            'password' => $data['password'],
        ]);
       $token= $user->createToken('')->plainTextToken;
       $response = [
        'user' => $user,
        'token' => $token];
       return response($response, 201);
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $user = User::where('email',$data['email'])->first();
        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response(['message' => 'User not found'], 401);
        } else {
            $token = $user->currentAccessToken()->plainTextToken;
            $response = [
                'user' => $user,
                'token' => $token];
            return response(201);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response(['message' => 'Logged out'], 200);
    }

}
