<?php

namespace Tests\Feature\Backend\Purpose;

use App\Models\Purpose;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class DeleteTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function unauthorized_users_cannot_delete_a_purpose()
    {
        $this->delete('/a/purposes/1')
            ->assertRedirect('/login');

        Purpose::create([
            'name' => 'Some Purpose'
        ]);

        $this->signIn();

        $this->delete('/a/purposes/1')
            ->assertStatus(Response::HTTP_FORBIDDEN);

        $this->assertDatabaseCount('purposes', 1);
    }

    /** @test */
    function authorized_users_can_delete_a_purpose()
    {
        $this->signIn(User::factory()->admin()->create());

        /** @var Purpose $purpose */
        $purpose = Purpose::create([
            'name' => 'Some Purpose'
        ]);

        $this->assertDatabaseCount('purposes', 1);

        $this->delete("/a/purposes/{$purpose->id}");

        $this->assertDatabaseCount('purposes', 0);
    }
}
