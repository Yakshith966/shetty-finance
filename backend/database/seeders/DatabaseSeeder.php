<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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
            // Add other seeders here if needed
        ]);
    }
}
