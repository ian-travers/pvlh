<?php

namespace Tests\Feature\Backend\Depot;

use App\Models\Depot;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class EditTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function unauthorized_users_cannot_delete_a_depot()
    {
        $this->patch('/a/depots/1')
            ->assertRedirect('/login');

        Depot::create([
            'name' => 'TCH-1'
        ]);

        $this->signIn();

        $this->patch('/a/depots/1')
            ->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /** @test */
    function authorized_users_can_edit_a_depot()
    {
        /** @var Depot $depot */
        $depot = Depot::create([
            'name' => 'TCH-1'
        ]);

        $this->signIn(User::factory()->admin()->create());

        $data = [
            'name' => 'UPD',
        ];

        $this->patch("/a/depots/{$depot->id}", $data);

        $this->assertEquals('UPD', $depot->fresh()->name);
    }

    /** @test */
    function editing_depot_name_must_be_unique()
    {
        Depot::create([
            'name' => 'solid'
        ]);

        /** @var Depot $depot */
        $depot = Depot::create([
            'name' => 'TCH-1'
        ]);

        $this->signIn(User::factory()->admin()->create());

        $data = [
            'name' => 'solid',
        ];

        $this->patch("/a/depots/{$depot->id}", $data)
            ->assertSessionHasErrors('name');
    }
}
