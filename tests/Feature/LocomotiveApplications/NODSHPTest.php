<?php

namespace Tests\Feature\LocomotiveApplications;

use App\Models\LocomotiveApplication;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\PrepareLocomotiveApplication;
use Tests\TestCase;

class NODSHPTest extends TestCase
{
    use RefreshDatabase, PrepareLocomotiveApplication;

    /** @test */
    function unauthorized_users_cannot_toggle_nodshp_approved()
    {
        $this->patch('/applications/1/toggle-nodshp')
            ->assertRedirect('/login');

        $data = $this->prepareApplication();

        $this->post('/applications', $data);

        // Verified user
        $this->signIn(User::factory()->verified()->create());

        $this->patch("/applications/1/toggle-nodshp")
            ->assertStatus(Response::HTTP_FORBIDDEN);

        // Customer
        $this->signIn(User::factory()->customer()->create());

        $this->patch("/applications/1/toggle-nodshp")
            ->assertStatus(Response::HTTP_FORBIDDEN);

        // NODN
        $this->signIn(User::factory()->nodn()->create());

        $this->patch("/applications/1/toggle-nodshp")
            ->assertStatus(Response::HTTP_FORBIDDEN);

        // NODT
        $this->signIn(User::factory()->nodt()->create());

        $this->patch("/applications/1/toggle-nodshp")
            ->assertStatus(Response::HTTP_FORBIDDEN);

        // NODZ
        $this->signIn(User::factory()->nodz()->create());

        $this->patch("/applications/1/toggle-nodshp")
            ->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /** @test */
    function authorized_users_can_toggle_nodshp_approved()
    {
        $data = $this->prepareApplication();

        $this->post('/applications', $data);

        // NODT
        $this->signIn(User::factory()->nodshp()->create());

        $this->patch("/applications/1/toggle-nodshp");

        $locApp = LocomotiveApplication::find(1);

        $this->assertTrue($locApp->fresh()->approvedNODSHP());

        $this->patch("/applications/1/toggle-nodshp");

        $this->assertFalse($locApp->fresh()->approvedNODSHP());

        // SA
        $this->signIn(User::factory()->SA()->create());

        $this->patch("/applications/1/toggle-nodshp");

        $this->assertTrue($locApp->approvedNODSHP());

        $this->patch("/applications/1/toggle-nodshp");

        $this->assertFalse($locApp->fresh()->approvedNODSHP());

        // admin
        $this->signIn(User::factory()->admin()->create());

        $this->patch("/applications/1/toggle-nodshp");

        $this->assertTrue($locApp->approvedNODSHP());

        $this->patch("/applications/1/toggle-nodshp");

        $this->assertFalse($locApp->fresh()->approvedNODSHP());
    }
}
