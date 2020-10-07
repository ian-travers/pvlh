<?php

namespace Tests\Feature\Backend;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function unauthorized_users_cannot_visit_backend_dashboard()
    {
        $this->get('/a')
            ->assertRedirect('/login');

        $this->signIn();

        $this->get('/a')
            ->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /** @test */
    function authorized_users_can_visit_backend_dashboard()
    {
        $this->withoutExceptionHandling();
        $this->signIn(User::factory()->admin()->create());

        $this->get('/a')
            ->assertOk();
    }
}
