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
    function non_verified_user_cannot_view_a_edit_part_of_profile_page()
    {
        /** @var User $user */
        $user = User::factory()->create();
        $this->signIn($user);

        $this->get('/profile')
            ->assertOk()
            ->assertDontSeeText('Настройки профиля');
    }

    /** @test */
    function verified_user_can_view_a_whole_profile_page()
    {
        $this->signIn();

        $this->get('/profile')
            ->assertOk()
            ->assertSeeText('Настройки профиля');
    }
}
