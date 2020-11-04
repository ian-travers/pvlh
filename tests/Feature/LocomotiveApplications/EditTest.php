<?php

namespace Tests\Feature\LocomotiveApplications;

use App\Models\LocomotiveApplication;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\PrepareLocomotiveApplication;
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

        $locApp = LocomotiveApplication::findOrFail(1);

        $this->signIn(User::factory()->customer()->create());

        $this->get("/applications/{$locApp->id}/edit")
            ->assertStatus(Response::HTTP_FORBIDDEN);

        $this->patch("/applications/{$locApp->id}", [])
            ->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /** @test */
    function authorized_users_can_update_applications()
    {
        $data = $this->prepareApplication();

        $this->post('/applications', $data);

        $locApp = LocomotiveApplication::findOrFail(1);

        $this->get("/applications/{$locApp->id}/edit")
            ->assertOk();

        $data = [
            'sections' => 2,
            'on_date' => now(),
            'count' => 2,
            'hours' => 2,
            'purpose_id' => 1,
            'depot_id' => 1,
            'customer_id' => 1,
            'description' => 'UPD',
        ];

        $this->patch("/applications/{$locApp->id}", $data);

        $this->assertDatabaseHas('locomotive_applications', $data);
    }

    /** @test */
    function approved_locApp_cannot_be_edited_or_updated()
    {
        $data = $this->prepareApplication();

        $this->post('/applications', $data);

        $locApp = LocomotiveApplication::findOrFail(1);

        $locApp->update([
            'is_nodn' => true,
        ]);

        $this->get("/applications/{$locApp->id}/edit")
            ->assertSessionHas('flash');

        $data = [
            'sections' => 2,
            'on_date' => now(),
            'count' => 2,
            'hours' => 2,
            'purpose_id' => 1,
            'depot_id' => 1,
            'customer_id' => 1,
            'description' => 'UPD',
        ];

        $this->patch("/applications/{$locApp->id}", $data)
            ->assertSessionHas('flash');
        $this->assertDatabaseHas('locomotive_applications', $locApp->getAttributes());
    }
}
