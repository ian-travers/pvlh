<?php

namespace Tests\Feature\Backend\Purpose;

use App\Models\Purpose;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class EditTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function unauthorized_users_cannot_delete_a_purpose()
    {
        $this->patch('/a/purposes/1')
            ->assertRedirect('/login');

        Purpose::create([
            'name' => 'Some Purpose'
        ]);

        $this->signIn();

        $this->patch('/a/purposes/1')
            ->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /** @test */
    function authorized_users_can_edit_a_purpose()
    {
        /** @var Purpose $purpose */
        $purpose = Purpose::create([
            'name' => 'Some Purpose'
        ]);

        $this->signIn(User::factory()->admin()->create());

        $data = [
            'name' => 'UPD',
        ];

        $this->patch("/a/purposes/{$purpose->id}", $data);

        $this->assertEquals('UPD', $purpose->fresh()->name);
    }

    /** @test */
    function editing_purpose_name_must_be_unique()
    {
        Purpose::create([
            'name' => 'solid'
        ]);

        /** @var Purpose $purpose */
        $purpose = Purpose::create([
            'name' => 'Some Purpose'
        ]);

        $this->signIn(User::factory()->admin()->create());

        $data = [
            'name' => 'solid',
        ];

        $this->patch("/a/purposes/{$purpose->id}", $data)
            ->assertSessionHasErrors('name');
    }
}
