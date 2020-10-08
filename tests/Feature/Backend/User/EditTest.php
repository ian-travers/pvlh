<?php

namespace Tests\Feature\Backend\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class EditTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function unauthorized_users_cannot_edit_a_user()
    {
        $this->patch('/a/users/{user}', [])
            ->assertRedirect('/login');

        $this->signIn();

        $this->patch('/a/users/1', [])
            ->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /** @test */
    function authorized_users_can_edit_a_user()
    {
        $this->withoutExceptionHandling();
        $this->signIn(User::factory()->admin()->create());

        /** @var User $user */
        $user = User::factory()->create();

        $data = [
            'name' => 'Name UPD',
            'position' => 'Position UPD',
            'email' => $user->email,
        ];

        $this->patch("/a/users/{$user->id}", $data);

        $this->assertDatabaseHas('users', $data);
    }
}
