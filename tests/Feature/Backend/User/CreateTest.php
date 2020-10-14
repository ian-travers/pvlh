<?php

namespace Tests\Feature\Backend\User;

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
        $this->post('/a/users', [])
            ->assertRedirect('/login');

        $this->signIn();

        $this->post('/a/users', [])
            ->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /** @test */
    function authorized_users_can_create_an_user()
    {
        $this->withoutExceptionHandling();
        $this->signIn(User::factory()->admin()->create());

        $user = [
            'name' => 'John',
            'email' => 'john@pvlh.lan',
            'position' => 'senior man',
            'password' => '12345678',
        ];

        $this->post('/a/users', $user);

        $this->assertDatabaseCount('users', 2);
        $this->assertDatabaseHas('users', [
            'name' => 'John',
            'email' => 'john@pvlh.lan',
            'position' => 'senior man',
        ]);
    }
}
