<?php

namespace App\Http\Controllers;

use App\Models\role;
use App\Models\User;
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
        $user->load('roles');
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
    public function fetchRoles(){
        $roles = role::all();
        return response()->json($roles);
    }
    public function fetchUsers(){
        $users = User::with('roles')->get();
        return response()->json($users);
        
    }
}