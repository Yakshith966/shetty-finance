<?php

namespace Database\Seeders;

use Database\Seeders\UserSeeder as SeedersUserSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Database\Seeders\UserSeeder;
use Database\Seeders\RolesTableSeeder as  SeedersRolesTableSeeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
           
            ServiceStatusSeeder::class,
            PaymentModeSeeder::class,
            PaymentStatusSeeder::class,
            SeedersRolesTableSeeder::class,
            SeedersUserSeeder::class,
            // Add other seeders here if needed
            
          
        ]);
    }
    
}
