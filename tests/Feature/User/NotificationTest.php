<?php

namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Notifications\DatabaseNotification;
use Str;
use Tests\TestCase;

class NotificationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function guest_cannot_manage_notifications()
    {
        $this->put('/notifications/1/toggle-read')
            ->assertRedirect('/login');
        $this->put('/notifications/1/delete')
            ->assertRedirect('/login');
    }

    /** @test */
    function verified_user_can_toggle_is_read_status()
    {
        /** @var User $user */
        $this->signIn($user = User::factory()->verified()->create());

        $user->notifications()->create([
            'id' => Str::uuid()->toString(),
            'type' => 'test',
            'data' => [
                'key' => 'value',
            ],
        ]);

        $this->assertDatabaseCount('notifications', 1);

        /** @var DatabaseNotification $notification */
        $notification = $user->notifications->first();

        $this->assertFalse($notification->read());

        // mark as read
        $this->put("/notifications/{$notification->id}/toggle-read");

        $this->assertTrue($notification->fresh()->read());

        // mark as unread
        $this->put("/notifications/{$notification}/toggle-read");

        $this->assertFalse($notification->read());
    }

    /** @test */
    function verified_user_can_delete_a_notification()
    {
        /** @var User $user */
        $this->signIn($user = User::factory()->verified()->create());

        $user->notifications()->create([
            'id' => Str::uuid()->toString(),
            'type' => 'test',
            'data' => [
                'key' => 'value',
            ],
        ]);

        $this->assertDatabaseCount('notifications', 1);

        /** @var DatabaseNotification $notification */
        $notification = $user->notifications->first();

        $this->put("/notifications/{$notification}/delete");

        $this->assertDatabaseCount('notifications', 1);
    }
}
