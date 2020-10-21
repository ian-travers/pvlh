<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class DepotsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('depots')->truncate();

        DB::table('depots')->insert([
            ['name' => 'ТЧ-16'],
            ['name' => 'ТЧ-17'],
            ['name' => 'ТД-9'],
        ]);
    }
}
