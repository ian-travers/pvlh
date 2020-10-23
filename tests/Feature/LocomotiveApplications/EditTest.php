<?php

namespace Tests\Feature\LocomotiveApplications;

use App\Models\LocomotiveApplication;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class EditTest extends TestCase
{
    use RefreshDatabase, PrepareLocomotiveApplication;

    /** @test */
    function guests_cannot_edit_an_application()
    {
        $this->get('/applications/1/edit')
            ->assertRedirect('/login');
        $this->patch('/applications/1', [])
            ->assertRedirect('/login');
    }

    /** @test */
    function users_can_neither_edit_nor_update_other_users_applications()
    {
        $data = $this->prepareApplication();

        $this->post('/applications', $data);

        $application = LocomotiveApplication::findOrFail(1);

        $this->signIn(User::factory()->verified()->customer()->create());

        $this->get("/applications/{$application->id}/edit")
            ->assertStatus(Response::HTTP_FORBIDDEN);

        $this->patch("/applications/{$application->id}", [])
            ->assertStatus(Response::HTTP_FORBIDDEN);
    }
}
