<?php

namespace Tests\Feature\Backend\Customer;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class DeleteTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function unauthorized_users_cannot_delete_a_customer()
    {
        $this->delete('/a/customers/1')
            ->assertRedirect('/login');

        Customer::create([
            'name' => 'PMS'
        ]);

        $this->signIn();

        $this->delete('/a/customers/1')
            ->assertStatus(Response::HTTP_FORBIDDEN);

        $this->assertDatabaseCount('customers', 1);
    }

    /** @test */
    function authorized_users_can_delete_a_customer()
    {
        $this->signIn(User::factory()->admin()->create());

        /** @var Customer $customer */
        $customer = Customer::create([
            'name' => 'PMS'
        ]);

        $this->assertDatabaseCount('customers', 1);

        $this->delete("/a/customers/{$customer->id}");

        $this->assertDatabaseCount('customers', 0);
    }
}
