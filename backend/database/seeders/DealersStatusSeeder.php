<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DealersStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dealers_status')->insert([
            ['status' => 'Sent'],
            ['status' => 'Received'],
        ]);
    }
}
