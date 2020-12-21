<?php

namespace Tests\Feature\LocomotiveApplications;

use App\Models\LocomotiveApplication;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\PrepareLocomotiveApplication;
use Tests\TestCase;

class DeleteTest extends TestCase
{
    use RefreshDatabase, PrepareLocomotiveApplication;

    /** @test */
    function unauthorized_users_cannot_delete_an_application()
    {
        $this->delete('/applications/1')
            ->assertRedirect('/login');

        $data = $this->prepareApplication();

        $this->post('/applications', $data);

        $this->signIn();
        $this->delete('/applications/1')
            ->assertStatus(Response::HTTP_FORBIDDEN);

        $this->signIn(User::factory()->nodshp()->create());
        $this->delete('/applications/1')
            ->assertStatus(Response::HTTP_FORBIDDEN);

        $this->signIn(User::factory()->nodt()->create());
        $this->delete('/applications/1')
            ->assertStatus(Response::HTTP_FORBIDDEN);

        $this->signIn(User::factory()->nodn()->create());
        $this->delete('/applications/1')
            ->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /** @test */
    function customers_can_delete_an_own_application()
    {
        $data = $this->prepareApplication();

        $this->post('/applications', $data);

        $this->assertDatabaseCount('locomotive_applications', 1);

        $this->delete('/applications/1');

        $this->assertDatabaseCount('locomotive_applications', 0);
    }

    /** @test */
    function the_SA_can_delete_any_application()
    {
        $data = $this->prepareApplication();

        $this->post('/applications', $data);

        $this->assertDatabaseCount('locomotive_applications', 1);

        $this->signIn(User::factory()->SA()->create());

        $this->delete('/applications/1');

        $this->assertDatabaseCount('locomotive_applications', 0);
    }

    /** @test */
    function the_admins_can_delete_any_application()
    {
        $data = $this->prepareApplication();

        $this->post('/applications', $data);

        $this->assertDatabaseCount('locomotive_applications', 1);

        $this->signIn(User::factory()->admin()->create());

        $this->delete('/applications/1');

        $this->assertDatabaseCount('locomotive_applications', 0);
    }

    /** @test */
    function approved_locApp_cannot_be_deleted()
    {
        $data = $this->prepareApplication();

        $this->post('/applications', $data);

        $locApp = LocomotiveApplication::findOrFail(1);

        $locApp->update([
            'is_nodn' => true,
        ]);

        $this->delete("/applications/{$locApp->id}")
            ->assertSessionHas('flash');
        $this->assertDatabaseHas('locomotive_applications', $locApp->getAttributes());
    }
}
