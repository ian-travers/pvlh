<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(PurposesTableSeeder::class);
        $this->call(DepotsTableSeeder::class);
        $this->call(CustomersTableSeeder::class);
    }
}
