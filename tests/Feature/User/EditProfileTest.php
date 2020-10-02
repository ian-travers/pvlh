<?php

namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EditProfileTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function guest_cannot_update_profile()
    {
        $this->post('/profile', [])
            ->assertRedirect('/login');
    }

    /** @test */
    function non_verified_user_cannot_update_profile()
    {
        /** @var User $user */
        $user = User::factory()->create();
        $this->signIn($user);

        $this->post('/profile', [])
            ->assertRedirect('/email/verify');
    }

    /** @test */
    function verified_user_can_update_a_profile()
    {
        $this->signIn();

        $data = [
            'name' => 'New name',
            'position' => 'New position',
            'is_browser_notified' => true,
            'is_email_notified' => true,
        ];

        $this->post('/profile', $data);

        $user = User::find(1);

        $this->assertEquals('New name', $user->name);
        $this->assertEquals('New position', $user->position);
        $this->assertNotNull($user->email_verified_at);
        $this->assertTrue($user->hasBrowserNotifications());
        $this->assertTrue($user->hasEmailNotifications());
    }
}
