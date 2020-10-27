<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class CustomersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('customers')->truncate();

        DB::table('customers')->insert([
            ['name' => 'ПЧ-10'],
            ['name' => 'ПЧ-11'],
            ['name' => 'ПЧ-12'],
            ['name' => 'ПМС Витебск'],
        ]);
    }
}
