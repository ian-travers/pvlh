<?php

namespace Tests\Feature\LocomotiveApplications;

use App\Models\LocomotiveApplication;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\PrepareLocomotiveApplication;
use Tests\TestCase;

class ShowTest extends TestCase
{
    use RefreshDatabase, PrepareLocomotiveApplication;

    /** @test */
    function guests_cannot_visit_an_application_page()
    {
        $this->get('/applications/1')
            ->assertRedirect('/login');
    }

    /** @test */
    function users_can_visit_an_application_page()
    {
        $data = $this->prepareApplication();

        $this->post('/applications', $data);

        $application = LocomotiveApplication::findOrFail(1);

        $this->signIn();

        $this->get("/applications/{$application->id}")
            ->assertOk();
    }
}
