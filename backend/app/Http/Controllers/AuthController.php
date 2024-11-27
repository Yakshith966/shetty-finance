<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function login(Request $request)
{

    $credentials = $request->only('user_name', 'password');

    if (!Auth::attempt(['user_name' => $credentials['user_name'], 'password' => $credentials['password']])) {
        return response()->json(['error' => 'Incorrect username or password'], 401);
    }

    $user = Auth::user();
    $token = $user->createToken('auth_token')->plainTextToken;
    // dd($token);

    return response()->json([
        'message' => 'Login successful',
        'token' => $token,
        'token_type' => 'Bearer',
        'user' => $user,
    ]);
}

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully']);
    }
}