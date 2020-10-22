<?php

namespace Tests\Feature\LocomotiveApplications;

use App\Models\User;

trait PrepareLocomotiveApplication
{
    protected function prepareApplication(array $overrides = []): array
    {
        $this->artisan('db:seed --class=PurposesTableSeeder');
        $this->artisan('db:seed --class=DepotsTableSeeder');

        $this->signIn(User::factory()->verified()->customer()->create());

        $data = array_merge([
            'sections' => 1,
            'on_date' => now(),
            'count' => 1,
            'hours' => 6,
            'purpose_id' => 1,
            'depot_id' => 1,
            'description' => 'workflow everywhere',
        ], $overrides);

        return $data;
    }
}
