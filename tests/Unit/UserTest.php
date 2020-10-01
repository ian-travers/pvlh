<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
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
}
