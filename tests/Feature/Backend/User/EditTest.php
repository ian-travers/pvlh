<?php

namespace Tests\Feature\Backend\User;

use App\Models\User;
use Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class EditTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function unauthorized_users_cannot_edit_an_user()
    {
        $this->patch('/a/users/{user}', [])
            ->assertRedirect('/login');

        $this->signIn();

        $this->patch('/a/users/1', [])
            ->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /** @test */
    function authorized_users_can_edit_an_user()
    {
        $this->signIn(User::factory()->admin()->create());

        /** @var User $user */
        $user = User::factory()->create();

        $data = [
            'name' => 'Name UPD',
            'role' => 'customer',
            'position' => 'Position UPD',
            'email' => $user->email,
        ];

        $this->patch("/a/users/{$user->id}", $data);

        $this->assertDatabaseHas('users', $data);
    }

    /** @test */
    function authorized_users_can_toggle_a_verified_user_browser_notifications()
    {
        $this->signIn(User::factory()->admin()->create());

        /** @var User $user */
        $user = User::factory()->verified()->create();

        $this->assertFalse($user->hasBrowserNotifications());

        $this->patch("/a/users/{$user->id}/toggle-bn");

        $this->assertTrue($user->fresh()->hasBrowserNotifications());
    }

    /** @test */
    function authorized_users_can_toggle_a_verified_user_email_notifications()
    {
        $this->signIn(User::factory()->admin()->create());

        /** @var User $user */
        $user = User::factory()->verified()->create();

        $this->assertFalse($user->hasEmailNotifications());

        $this->patch("/a/users/{$user->id}/toggle-en");

        $this->assertTrue($user->fresh()->hasEmailNotifications());
    }

    /** @test */
    function authorized_users_can_change_password()
    {
        $this->signIn(User::factory()->admin()->create());

        /** @var User $user */
        $user = User::factory()->verified()->create();

        $formData = [
            'password' => '12345678',
            'userId' => $user->id,
        ];

        $this->post("/a/users/change-password", $formData);

        $this->assertTrue(Hash::check('12345678', $user->fresh()->password));
    }
}
