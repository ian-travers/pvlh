<?php

namespace Tests\Feature\LocomotiveApplications;

use App\Models\LocomotiveApplication;
use App\Models\User;
use App\Notifications\LocomotiveApplicationApproved;
use App\Notifications\LocomotiveApplicationNotApproved;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Notification;
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

    /** @test */
    function owner_with_browser_notifying_receives_a_valid_notification()
    {
        $data = $this->prepareApplication();

        $this->post('/applications', $data);

        $owner = auth()->user();

        $this->signIn(User::factory()->nodshp()->create());

        // toggle to approved
        $this->patch("/applications/1/toggle-nodshp");

        $this->assertCount(1, $owner->notifications);

        $this->assertEquals(LocomotiveApplicationApproved::class, $owner->notifications->last()->toArray()['type']);

        // toggle to not approved
        $this->patch("/applications/1/toggle-nodshp");

        $this->assertEquals(LocomotiveApplicationNotApproved::class, $owner->fresh()->notifications->last()->toArray()['type']);
    }

    /** @test */
    function nodshp_notify_locApp_owner_if_subscribed()
    {
        $data = $this->prepareApplication();

        $this->post('/applications', $data);

        Notification::fake();

        /** @var User $owner */
        $owner = auth()->user();

        $owner->update(['is_browser_notified' => true]);

        $this->assertCount(0, $owner->notifications);

        $this->signIn(User::factory()->nodshp()->create());

        // toggle to approved
        $this->patch("/applications/1/toggle-nodshp");

        Notification::assertSentTo($owner, LocomotiveApplicationApproved::class);

        // toggle to non approved
        $this->patch("/applications/1/toggle-nodshp");

        Notification::assertSentTo($owner, LocomotiveApplicationNotApproved::class);
    }
}
