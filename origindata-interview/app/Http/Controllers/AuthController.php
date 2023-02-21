<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Authentication successful

            $user = User::find(1);
            // $user = User::where('email', $credentials['email'])->first();
            $token = $user->createToken('auth_token');

            return response()->json([
                'message' => 'Logged in successfully',
                'access_token' => $token,
                'token_type' => 'Bearer'
            ]);
        }
        // Authentication failed
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|string|min:8',
        ]);

        //Unprocessable request
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $token = $user->createToken('auth_token');
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json(['message' => 'User created successfully', 'success' => $token], 201);
    }
}
