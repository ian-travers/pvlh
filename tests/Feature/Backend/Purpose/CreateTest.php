<?php

namespace Tests\Feature\Backend\Purpose;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function unauthorized_users_cannot_create_an_user()
    {
        $this->post('/a/purposes', [])
            ->assertRedirect('/login');

        $this->signIn();

        $this->post('/a/purposes', [])
            ->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /** @test */
    function authorized_users_can_create_a_purpose()
    {
        $this->signIn(User::factory()->admin()->create());

        $purpose = [
            'name' => 'New Purpose',
        ];

        $this->post('/a/purposes', $purpose);

        $this->assertDatabaseCount('purposes', 1);
        $this->assertDatabaseHas('purposes', $purpose);
    }
}
