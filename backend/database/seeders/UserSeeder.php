<?php

namespace Database\Seeders;

use App\Models\UserLogin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'user_name' => 'admin@example.com',
             'email' => 'admin@example.com',
            'password' => Hash::make('password123'), 
            'role_id' => 1, 
            
        ]);
    }
}
