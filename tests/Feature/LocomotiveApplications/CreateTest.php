<?php

namespace Tests\Feature\LocomotiveApplications;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\PrepareLocomotiveApplication;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use RefreshDatabase, PrepareLocomotiveApplication;

    /** @test */
    function unauthorized_users_cannot_create_an_application()
    {
        $this->post('/applications', [])
            ->assertRedirect('/login');

        $this->signIn();

        $this->post('/applications', [])
            ->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /** @test */
    function authenticated_users_can_create_an_application()
    {
        $data = $this->prepareApplication();

        $this->post('/applications', $data);

        $this->assertDatabaseCount('locomotive_applications', 1);
        $this->assertDatabaseHas('locomotive_applications', $data);
    }

    /** @test */
    function locomotive_application_requires_an_on_date()
    {
        $this->post('/applications', $this->prepareApplication(['on_date' => null]))
            ->assertSessionHasErrors('on_date');
    }

    /** @test */
    function locomotive_application_requires_a_sections()
    {
        $this->post('/applications', $this->prepareApplication(['sections' => null]))
            ->assertSessionHasErrors('sections');
    }

    /** @test */
    function locomotive_application_requires_a_count()
    {
        $this->post('/applications', $this->prepareApplication(['count' => null]))
            ->assertSessionHasErrors('count');
    }

    /** @test */
    function locomotive_application_requires_a_hours()
    {
        $this->post('/applications', $this->prepareApplication(['hours' => null]))
            ->assertSessionHasErrors('hours');
    }

    /** @test */
    function locomotive_application_requires_a_valid_depot_id()
    {
        $this->post('/applications', $this->prepareApplication(['depot_id' => null]))
            ->assertSessionHasErrors('depot_id');

        $this->post('/applications', $this->prepareApplication(['depot_id' => 999]))
            ->assertSessionHasErrors('depot_id');
    }

    /** @test */
    function locomotive_application_requires_a_purpose_id()
    {
        $this->post('/applications', $this->prepareApplication(['purpose_id' => null]))
            ->assertSessionHasErrors('purpose_id');
        $this->post('/applications', $this->prepareApplication(['purpose_id' => 999]))
            ->assertSessionHasErrors('purpose_id');
    }

    /** @test */
    function locomotive_application_requires_a_description()
    {
        $this->post('/applications', $this->prepareApplication(['description' => null]))
            ->assertSessionHasErrors('description');
    }
}
