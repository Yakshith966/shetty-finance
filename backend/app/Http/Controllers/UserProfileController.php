<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->only(['user_name', 'email']));
        
        $user->load('roles');
        return response()->json([
            'message' => 'User data updated successfully',
            'user' => $user,
        ]);
    }
    public function updatePassword(Request $request, $id){
        $request->validate([
            'password' => 'required|string|min:6',
        ]);

       try {
            $user = User::findOrFail($id);

            if (!$user) {
                return response()->json(['message' => 'User not found'], 404);
            }

            $user->password = Hash::make($request->password);
            $user->save();

            $user->tokens()->delete();

            $newToken = $user->createToken('authToken')->plainTextToken;

            return response()->json([
                'message' => 'Password updated successfully',
                'token' => $newToken,
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to update password'], 500);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
