<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // You can add logic here to seed the branches table.
        // For example, you might want to insert some default branches.

        // Example:
        DB::table('branches')->insert([
            ['name' => 'Mangalore', 'location' => 'Mangalore'],
            ['name' => 'Udupi', 'location' => 'Udupi'],
            ['name' => 'Bangalore', 'location' => 'Bangalore'],
            ['name' => 'Kundapura', 'location' => 'Kundapura'],
            ['name' => 'Karkala', 'location' => 'Karkala'],
            ['name' => 'Manipal', 'location' => 'Manipal'],
            ['name' => 'Kasaragod', 'location' => 'Kasaragod'],
            ['name' => 'Puttur', 'location' => 'Puttur'],
            ['name' => 'Sullia', 'location' => 'Sullia'],
            ['name' => 'Moodbidri', 'location' => 'Moodbidri'],
        ]);
        
        // Note: Make sure to import the necessary classes if you use DB or any other model.
    }
}
