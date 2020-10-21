<?php

namespace Tests\Feature\LocomotiveApplications;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use RefreshDatabase;

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
        $this->withoutExceptionHandling();
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

    protected function prepareApplication(array $overrides = []): array
    {
        $this->artisan('db:seed --class=PurposesTableSeeder');
        $this->artisan('db:seed --class=DepotsTableSeeder');

        $user = User::factory()->verified()->customer()->create();
        $this->signIn($user);

        $data = array_merge([
            'sections' => 1,
            'on_date' => now(),
            'count' => 1,
            'hours' => 6,
            'purpose_id' => 1,
            'depot_id' => 1,
            'description' => 'workflow everywhere',
        ], $overrides);

        return $data;
    }
}
