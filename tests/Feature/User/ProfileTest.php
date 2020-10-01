<?php

namespace Tests\Feature\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function guest_cannot_view_a_profile_page()
    {
        $this->withoutExceptionHandling();
        $this->get('/profile')
            ->assertRedirect('/login');
    }
}
