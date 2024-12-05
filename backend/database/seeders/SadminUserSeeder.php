<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Illuminate\Database\Seeder;

class SadminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'user_name' => 'sadmin',
            'email' => 'sadmin@example.com', 
            'role_id' => 3, 
            'password' => Hash::make('sadmin@123'),
            'is_sadmin' => 1,
        ]);
    }
}
