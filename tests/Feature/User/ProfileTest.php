<?php

namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function guest_cannot_view_a_profile_page()
    {
        $this->get('/profile')
            ->assertRedirect('/login');
    }

    /** @test */
    function non_verified_user_cannot_view_a_profile_page()
    {
        /** @var User $user */
        $user = User::factory()->create();
        $this->signIn($user);

        $this->get('/profile')
            ->assertRedirect('/email/verify');
    }
}
