<?php

namespace App\Http\Controllers;

use App\Models\role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    public function fetchRoles()
    {
        $roles = Role::where('id', '!=', 3)->get();
        return response()->json($roles);
    }
    public function fetchUsers()
    {
        $users = User::with('roles')
        ->where(function ($query) {
            $query->where('is_sadmin', '!=', 1)
            ->orWhereNull('is_sadmin');
        })
            ->get();

        return response()->json($users);
    }
    public function saveUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_name' => 'required|string|max:255|unique:users,user_name', 
            'email' => 'required|email|unique:users,email',
            'role_id' => 'required|exists:roles,id',
            'password' => 'required|string|min:5', 
        ], [
            'user_name.unique' => 'The user name has already been taken.', 
            'role_id.required' => 'Role name is required.', 
            'role_id.exists' => 'The selected role is invalid.', 
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first()
            ], 422);
        }

        try {
            $user = User::create([
                'user_name' => $request->user_name,
                'email' => $request->email,
                'role_id' => $request->role_id,
                'password' => Hash::make($request->password),
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'User created successfully',
                'data' => $user
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create user. Please try again.'
            ], 500);
        }
    }
    public function updateUser(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found.'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'user_name' => 'required|string|max:255|unique:users,user_name,' . $id, 
            'email' => 'required|email|unique:users,email,' . $id, 
            'role_id' => 'required|exists:roles,id', 
        ], [
            'user_name.unique' => 'The user name has already been taken.', 
            'role_id.required' => 'Role name is required.', 
            'role_id.exists' => 'The selected role is invalid.', 
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first()
            ], 422);
        }

        try {
            $user->update([
                'user_name' => $request->user_name,
                'email' => $request->email,
                'role_id' => $request->role_id,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'User updated successfully',
                'data' => $user
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update user. Please try again.'
            ], 500);
        }
    }


    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:users,id',
            'password' => 'required|string|min:5',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
            ], 422);
        }

        try {

            $user = User::findOrFail($request->id);
            $user->password = Hash::make($request->password);
            $user->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Password reset successfully.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to reset the password. Please try again.',
            ], 500);
        }
    }
}