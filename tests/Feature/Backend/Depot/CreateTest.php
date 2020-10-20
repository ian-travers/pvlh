<?php

namespace Tests\Feature\Backend\Depot;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function unauthorized_users_cannot_create_a_depot()
    {
        $this->post('/a/depots', [])
            ->assertRedirect('/login');

        $this->signIn();

        $this->post('/a/depots', [])
            ->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /** @test */
    function authorized_users_can_create_a_depot()
    {
        $this->signIn(User::factory()->admin()->create());

        $depot = [
            'name' => 'TCH-1',
        ];

        $this->post('/a/depots', $depot);

        $this->assertDatabaseCount('depots', 1);
        $this->assertDatabaseHas('depots', $depot);
    }

    /** @test */
    function depot_name_must_be_unique()
    {
        $this->signIn(User::factory()->admin()->create());

        $depot = [
            'name' => 'TCH-1',
        ];

        $this->post('/a/depots', $depot);

        $this->assertDatabaseHas('depots', $depot);

        $this->post('/a/depots', $depot)
            ->assertSessionHasErrors('name');

        $this->assertDatabaseCount('depots', 1);
    }
}
