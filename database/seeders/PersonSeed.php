<?php

namespace Database\Seeders;

use App\Models\Person;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PersonSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       
        for ($i = 0; $i < 50; $i++) {
            Person::create([
                'name' => 'Name' . rand(1, 1000),
                'email' => 'email' . rand(1000, 9999) . '@example.com', 
                'phone' => '555-' . rand(1000000, 9999999),
                'category' => ['Works', 'Friend', 'Family', 'Other'][rand(0, 3)], 
            ]);
        }
    }
}
