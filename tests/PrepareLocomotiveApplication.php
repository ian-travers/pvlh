<?php

namespace Tests;

use App\Models\User;

trait PrepareLocomotiveApplication
{
    protected function prepareApplication(array $overrides = []): array
    {
        $this->artisan('db:seed --class=PurposesTableSeeder');
        $this->artisan('db:seed --class=DepotsTableSeeder');
        $this->artisan('db:seed --class=CustomersTableSeeder');

        $this->signIn(User::factory()->customer()->create());

        return array_merge([
            'sections' => 1,
            'on_date' => now(),
            'count' => 1,
            'hours' => 6,
            'purpose_id' => 1,
            'depot_id' => 1,
            'customer_id' => 1,
            'description' => 'workflow everywhere',
        ], $overrides);
    }
}
