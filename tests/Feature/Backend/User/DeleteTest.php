<?php

namespace Tests\Feature\Backend\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class DeleteTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function unauthorized_users_cannot_delete_an_user()
    {
        $this->post('/a/users/delete', [])
            ->assertRedirect('/login');

        $this->signIn();

        $this->post('/a/users/delete', [])
            ->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /** @test */
    function authorized_users_can_delete_an_user()
    {
        $this->signIn(User::factory()->admin()->create());

        /** @var User $user */
        $user = User::factory()->verified()->create();

        $this->assertDatabaseCount('users', 2);

        $this->post("/a/users/delete", ['userId' => $user->id]);

        $this->assertDatabaseCount('users', 1);
    }
}
