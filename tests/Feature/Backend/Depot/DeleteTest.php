<?php

namespace Tests\Feature\Backend\Depot;

use App\Models\Depot;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class DeleteTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function unauthorized_users_cannot_delete_a_depot()
    {
        $this->delete('/a/depots/1')
            ->assertRedirect('/login');

        Depot::create([
            'name' => 'PMS'
        ]);

        $this->signIn();

        $this->delete('/a/depots/1')
            ->assertStatus(Response::HTTP_FORBIDDEN);

        $this->assertDatabaseCount('depots', 1);
    }

    /** @test */
    function authorized_users_can_delete_a_depot()
    {
        $this->signIn(User::factory()->admin()->create());

        /** @var Depot $depot */
        $depot = Depot::create([
            'name' => 'PMS'
        ]);

        $this->assertDatabaseCount('depots', 1);

        $this->delete("/a/depots/{$depot->id}");

        $this->assertDatabaseCount('depots', 0);
    }
}
