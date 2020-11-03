<?php

namespace Tests\Feature\LocomotiveApplications;

use App\Models\LocomotiveApplication;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\PrepareLocomotiveApplication;
use Tests\TestCase;

class NODNTest extends TestCase
{
    use RefreshDatabase, PrepareLocomotiveApplication;

    /** @test */
    function unauthorized_users_cannot_toggle_nodn_approved()
    {
        $this->patch('/applications/1/toggle-nodn')
            ->assertRedirect('/login');

        // Verified user
        $this->signIn(User::factory()->verified()->create());

        $this->patch("/applications/1/toggle-nodn")
            ->assertStatus(Response::HTTP_FORBIDDEN);

        // Customer
        $this->signIn(User::factory()->customer()->create());

        $this->patch("/applications/1/toggle-nodn")
            ->assertStatus(Response::HTTP_FORBIDDEN);

        // NODT
        $this->signIn(User::factory()->nodt()->create());

        $this->patch("/applications/1/toggle-nodn")
            ->assertStatus(Response::HTTP_FORBIDDEN);

        // NODSHP
        $this->signIn(User::factory()->nodshp()->create());

        $this->patch("/applications/1/toggle-nodn")
            ->assertStatus(Response::HTTP_FORBIDDEN);

        // NODZ
        $this->signIn(User::factory()->nodz()->create());

        $this->patch("/applications/1/toggle-nodn")
            ->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /** @test */
    function authorized_users_can_toggle_nodn_approved()
    {
        $data = $this->prepareApplication();

        $this->post('/applications', $data);

        // NODN
        $this->signIn(User::factory()->nodn()->create());

        $this->patch("/applications/1/toggle-nodn");

        $locApp = LocomotiveApplication::find(1);

        $this->assertTrue($locApp->approvedNODN());

        $this->patch("/applications/1/toggle-nodn");

        $this->assertFalse($locApp->fresh()->approvedNODN());

        // SA
        $this->signIn(User::factory()->SA()->create());

        $this->patch("/applications/1/toggle-nodn");

        $this->assertTrue($locApp->approvedNODN());

        $this->patch("/applications/1/toggle-nodn");

        $this->assertFalse($locApp->fresh()->approvedNODN());

        // admin
        $this->signIn(User::factory()->admin()->create());

        $this->patch("/applications/1/toggle-nodn");

        $this->assertTrue($locApp->approvedNODN());

        $this->patch("/applications/1/toggle-nodn");

        $this->assertFalse($locApp->fresh()->approvedNODN());
    }
}
