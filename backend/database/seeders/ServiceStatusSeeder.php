<?php

namespace Database\Seeders;

use App\Models\ServiceStatus;
use Illuminate\Database\Seeder;

class ServiceStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert default service statuses into the 'service_status' table
        ServiceStatus::create(['status' => 'Recieved']);
        ServiceStatus::create(['status' => 'In Repair']);
        ServiceStatus::create(['status' => 'Rapaired']);
    }
}
