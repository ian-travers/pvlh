<?php

namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function guest_can_register_an_account_with_valid_form_data()
    {
        $user = [
            'name' => 'first',
            'email' => 'first@tasd.com',
            'position' => 'manager',
            'password' => '12345678',
            'password_confirmation' => '12345678',
        ];

        $this->post('/register', $user);

        $this->assertEquals(1, User::count());
    }

    /** @test */
    function register_new_users_not_verifies_their_email()
    {
        /** @var User $user */
        $user = User::factory()->create();

        $this->assertFalse($user->hasVerifiedEmail());
    }

    /** @test */
    function register_new_users_not_set_their_notify_flags()
    {
        /** @var User $user */
        $user = User::factory()->create();

        $this->assertFalse($user->hasBrowserNotifications());
        $this->assertFalse($user->hasEmailNotifications());
    }

    /** @test */
    function registration_a_new_user_not_make_him_an_admin()
    {
        /** @var User $user */
        $user = User::factory()->create();

        $this->assertFalse($user->isAdmin());
    }
}
