<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class PurposesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('purposes')->truncate();

        DB::table('purposes')->insert([
            ['name' => 'Снегоборьба'],
            ['name' => 'Замена рельсов'],
        ]);
    }
}
