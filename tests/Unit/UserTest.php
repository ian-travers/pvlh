<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function not_verified_user_returns_valid_notifications_status()
    {
        /** @var User $user */
        $user = User::factory()->make();

        $this->assertFalse($user->hasBrowserNotifications());
        $this->assertFalse($user->hasEmailNotifications());
    }

    /** @test */
    function just_verified_user_returns_valid_notifications_status()
    {
        /** @var User $user */
        $user = User::factory()->verified()->make();

        $this->assertFalse($user->hasBrowserNotifications());
        $this->assertFalse($user->hasEmailNotifications());
    }

    /** @test */
    function verified_user_with_browser_notifying_returns_valid_notifications_status()
    {
        /** @var User $user */
        $user = User::factory()->verified()->browserNotified()->make();

        $this->assertTrue($user->hasBrowserNotifications());
        $this->assertFalse($user->hasEmailNotifications());
    }

    /** @test */
    function verified_user_with_email_notifying_returns_valid_notifications_status()
    {
        /** @var User $user */
        $user = User::factory()->verified()->emailNotified()->make();

        $this->assertFalse($user->hasBrowserNotifications());
        $this->assertTrue($user->hasEmailNotifications());
    }

    /** @test */
    function verified_user_with_browser_and_email_notifying_returns_valid_notifications_status()
    {
        /** @var User $user */
        $user = User::factory()->verified()->browserNotified()->emailNotified()->make();

        $this->assertTrue($user->hasBrowserNotifications());
        $this->assertTrue($user->hasEmailNotifications());
    }

    /** @test */
    function user_may_be_assigned_and_revoked_as_admin()
    {
        /** @var User $user */
        $user = User::factory()->create();

        $user->setAdminRights();

        $this->assertTrue($user->fresh()->isAdmin());

        $user->revokeAdminRights();

        $this->assertFalse($user->fresh()->isAdmin());
    }

    /** @test */
    function it_returns_info_for_dashboard()
    {
       User::factory()->create();
       User::factory()->verified()->create();

       $info = User::getUsersInfo();

       $this->assertCount(2, $info);
       $this->assertEquals(2, $info['countAll']);
       $this->assertEquals(1, $info['countVerified']);
    }

    /** @test */
    function it_returns_browser_subscribers()
    {
        User::factory()->verified()->browserNotified()->count(2)->create();
        User::factory()->verified()->count(1)->create();

        $this->assertCount(3, User::all());

        $browserSubscribers = User::browserNotified();

        $this->assertCount(2, $browserSubscribers);
        $this->assertInstanceOf(Collection::class, $browserSubscribers);
    }

    /** @test */
    function it_returns_email_subscribers()
    {
        User::factory()->verified()->emailNotified()->count(2)->create();
        User::factory()->verified()->count(1)->create();

        $this->assertCount(3, User::all());

        $emailSubscribers = User::emailNotified();

        $this->assertCount(2, $emailSubscribers);
        $this->assertInstanceOf(Collection::class, $emailSubscribers);
    }
}
