<?php

namespace Tests\Feature\User;

use App\Models\User;
use Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ChangePasswordTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function guest_cannot_change_password()
    {
        $this->post('/profile/password', [])
            ->assertRedirect('/login');
    }

    /** @test */
    function authenticated_user_can_change_email()
    {
        /** @var User $user */
        $user = User::factory()->create();
        $this->signIn($user);

        $newPassword = '14725836';

        $formData = [
            'password' => $newPassword,
            'password_confirmation' => $newPassword,
        ];

        $this->post('/profile/password', $formData);

        $user = User::find(1);

        $this->assertTrue(Hash::check($newPassword, $user->password));
    }
}
