<?php

namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ChangeEmailTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function guest_cannot_change_email()
    {
        $this->post('/profile/email', [])
            ->assertRedirect('/login');
    }

    /** @test */
    function authenticated_user_can_change_email()
    {
        /** @var User $user */
        $user = User::factory()->create();
        $this->signIn($user);

        $this->post('/profile/email', ['email' => 'new@mail.got']);

        $user = User::find(1);

        $this->assertEquals('new@mail.got', $user->email);
    }

    /** @test */
    function authenticated_user_cannot_change_email_if_it_already_used()
    {
        User::factory()->create(['email' => 'done@ex.com']);
        $this->signIn();

        $this->post('/profile/email', ['email' => 'done@ex.com'])
            ->assertSessionHasErrors('email');
    }
}
