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
            'sections' => rand(1, 2),
            'on_date' => today()->addDays(rand(0, 30)),
            'count' => rand(1, 3),
            'hours' => rand(1, 8),
            'purpose_id' => rand(1, 5),
            'depot_id' => rand(1, 3),
            'customer_id' => rand(1, 4),
            'is_nodn' => 0,
            'is_nodt' => 0,
            'is_nodshp' => 0,
            'description' => 'workflow everywhere',
        ];
    }

    public function approved()
    {
        return $this->state([
            'is_nodn' => 1,
            'is_nodt' => 1,
            'is_nodshp' => 1,
        ]);
    }
}
