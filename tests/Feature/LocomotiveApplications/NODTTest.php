<?php

namespace Tests\Feature\LocomotiveApplications;

use App\Models\LocomotiveApplication;
use App\Models\User;
use App\Notifications\LocomotiveApplicationApproved;
use App\Notifications\LocomotiveApplicationNotApproved;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\PrepareLocomotiveApplication;
use Tests\TestCase;

class NODTTest extends TestCase
{
    use RefreshDatabase, PrepareLocomotiveApplication;

    /** @test */
    function unauthorized_users_cannot_toggle_nodt_approved()
    {
        $this->patch('/applications/1/toggle-nodt')
            ->assertRedirect('/login');

        $data = $this->prepareApplication();

        $this->post('/applications', $data);

        // Verified user
        $this->signIn(User::factory()->verified()->create());

        $this->patch("/applications/1/toggle-nodt")
            ->assertStatus(Response::HTTP_FORBIDDEN);

        // Customer
        $this->signIn(User::factory()->customer()->create());

        $this->patch("/applications/1/toggle-nodt")
            ->assertStatus(Response::HTTP_FORBIDDEN);

        // NODN
        $this->signIn(User::factory()->nodn()->create());

        $this->patch("/applications/1/toggle-nodt")
            ->assertStatus(Response::HTTP_FORBIDDEN);

        // NODSHP
        $this->signIn(User::factory()->nodshp()->create());

        $this->patch("/applications/1/toggle-nodt")
            ->assertStatus(Response::HTTP_FORBIDDEN);

        // NODZ
        $this->signIn(User::factory()->nodz()->create());

        $this->patch("/applications/1/toggle-nodt")
            ->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /** @test */
    function authorized_users_can_toggle_nodt_approved()
    {
        $data = $this->prepareApplication();

        $this->post('/applications', $data);

        // NODT
        $this->signIn(User::factory()->nodt()->create());

        $this->patch("/applications/1/toggle-nodt");

        $locApp = LocomotiveApplication::find(1);

        $this->assertTrue($locApp->fresh()->approvedNODT());

        $this->patch("/applications/1/toggle-nodt");

        $this->assertFalse($locApp->fresh()->approvedNODT());

        // SA
        $this->signIn(User::factory()->SA()->create());

        $this->patch("/applications/1/toggle-nodt");

        $this->assertTrue($locApp->approvedNODT());

        $this->patch("/applications/1/toggle-nodt");

        $this->assertFalse($locApp->fresh()->approvedNODT());

        // admin
        $this->signIn(User::factory()->admin()->create());

        $this->patch("/applications/1/toggle-nodt");

        $this->assertTrue($locApp->approvedNODT());

        $this->patch("/applications/1/toggle-nodt");

        $this->assertFalse($locApp->fresh()->approvedNODT());
    }

    /** @test */
    function owner_with_browser_notifying_receives_a_valid_notification()
    {
        $data = $this->prepareApplication();

        $this->post('/applications', $data);

        $owner = auth()->user();

        $this->signIn(User::factory()->nodt()->create());

        // toggle to approved
        $this->patch("/applications/1/toggle-nodt");

        $this->assertCount(1, $owner->notifications);

        $this->assertEquals(LocomotiveApplicationApproved::class, $owner->notifications->last()->toArray()['type']);

        // toggle to not approved
        $this->patch("/applications/1/toggle-nodt");

        $this->assertEquals(LocomotiveApplicationNotApproved::class, $owner->fresh()->notifications->last()->toArray()['type']);
    }
}
