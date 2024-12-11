<?php

namespace Database\Seeders;

use App\Models\PaymentMode;
use Illuminate\Database\Seeder;

class PaymentModeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert default payment mode into the 'payment_mode' table
        PaymentMode::create(['mode' => 'Online']);
        PaymentMode::create(['mode' => 'Cash']);
        PaymentMode::create(['mode' => 'Card']);

    }
}
