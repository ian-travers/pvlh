<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'position' => $this->faker->jobTitle,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => null,
            'is_browser_notified' => false,
            'is_email_notified' => false,
            'is_admin' => false,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

    public function verified()
    {
        return $this->state([
            'email_verified_at' => now(),
        ]);
    }

    public function browserNotified()
    {
        return $this->state([
            'is_browser_notified' => true,
        ]);
    }

    public function emailNotified()
    {
        return $this->state([
            'is_email_notified' => true,
        ]);
    }

    public function admin()
    {
        return $this->state([
            'is_admin' => true,
        ]);
    }
}
