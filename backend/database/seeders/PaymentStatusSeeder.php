<?php

namespace Database\Seeders;

use App\Models\PaymentStatus;
use Illuminate\Database\Seeder;

class PaymentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    
    public function run()
    {
        // Insert default payment statuses into the 'payment_status' table
        PaymentStatus::create(['payment_status' => 'Pending']);
        PaymentStatus::create(['payment_status' => 'Paid']);
        PaymentStatus::create(['payment_status' => 'Partially paid']);
    }
}
