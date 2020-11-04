<?php

namespace Database\Factories;

use App\Models\LocomotiveApplication;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LocomotiveApplicationFactory extends Factory
{
    protected $model = LocomotiveApplication::class;

    public function definition()
    {
        $user = User::factory()->create();

        return [
            'user_id' => $user->id,
            'sections' => 1,
            'on_date' => now(),
            'count' => 1,
            'hours' => 6,
            'purpose_id' => 1,
            'depot_id' => 1,
            'customer_id' => 1,
            'is_nodn' => 0,
            'is_nodt' => 0,
            'is_nodshp' => 0,
            'description' => 'workflow everywhere',
        ];
    }
}
