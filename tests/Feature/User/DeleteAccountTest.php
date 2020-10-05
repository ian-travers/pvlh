<?php

namespace Tests\Feature\User;

use App\Models\User;
use Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteAccountTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function guest_cannot_delete_an_account()
    {
        $this->post('/profile/delete', [])
            ->assertRedirect('/login');
    }

    /** @test */
    function authenticated_user_may_delete_own_account()
    {
        /** @var User $user */
        $user = User::factory()->create([
            'password' => Hash::make('password'),
        ]);
        $this->signIn($user);

        $this->assertDatabaseCount('users', 1);

        $deleteForm = [
            'passwordCheck' => 'password',
            'verifyPhrase' => 'delete my account',
        ];

        $this->post('/profile/delete', $deleteForm);

        $this->assertDatabaseCount('users', 0);
    }
}
