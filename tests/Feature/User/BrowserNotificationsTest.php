<?php

namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\PrepareLocomotiveApplication;
use Tests\TestCase;

class BrowserNotificationsTest extends TestCase
{
    use RefreshDatabase, PrepareLocomotiveApplication;

    /** @test */
    function user_created_a_locApp_is_not_notified()
    {
        $data = $this->prepareApplication();

        /** @var User $user */
        $user = auth()->user();

        if (!$user->hasBrowserNotifications()) {
            $user->toggleBrowserNotification();
        }

        $this->assertCount(0, $user->notifications);

        $this->post('/applications', $data);

        $this->assertCount(0, $user->fresh()->notifications);
    }

    /** @test */
    function user_with_browser_notifying_get_it_when_a_new_locApp_is_created()
    {
        /** @var User $subscriber */
        $subscriber = User::factory()->verified()->browserNotified()->create();

        $this->assertCount(0, $subscriber->notifications);

        $this->post('/applications', $this->prepareApplication());

        $this->assertCount(1, $subscriber->fresh()->notifications);
    }

    /** @test */
    function user_can_fetch_his_unread_browser_notifications()
    {
        /** @var User $subscriber */
        $subscriber = User::factory()->verified()->browserNotified()->create();

        $this->post('/applications', $this->prepareApplication());

        $this->signIn($subscriber);

        $response = $this->get('/notifications')->json();

        $this->assertCount(1, $response);
    }

    /** @test */
    function user_can_mark_a_browser_browser_notification_as_read()
    {
        /** @var User $subscriber */
        $subscriber = User::factory()->verified()->browserNotified()->create();

        $this->post('/applications', $this->prepareApplication());

        $this->assertCount(1, $subscriber->unreadNotifications);

        $notification = $subscriber->unreadNotifications->first();

        $this->signIn($subscriber);

        $this->delete("/notifications/{$notification->id}");

        $this->assertCount(0, $subscriber->fresh()->unreadNotifications);

    }
}
