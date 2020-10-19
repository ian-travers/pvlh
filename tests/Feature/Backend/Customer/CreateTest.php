<?php

namespace Tests\Feature\Backend\Customer;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function unauthorized_users_cannot_create_a_customer()
    {
        $this->post('/a/customers', [])
            ->assertRedirect('/login');

        $this->signIn();

        $this->post('/a/customers', [])
            ->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /** @test */
    function authorized_users_can_create_a_customer()
    {
        $this->signIn(User::factory()->admin()->create());

        $customer = [
            'name' => 'PMS',
        ];

        $this->post('/a/customers', $customer);

        $this->assertDatabaseCount('customers', 1);
        $this->assertDatabaseHas('customers', $customer);
    }

    /** @test */
    function customer_name_must_be_unique()
    {
        $this->signIn(User::factory()->admin()->create());

        $customer = [
            'name' => 'PMS',
        ];

        $this->post('/a/customers', $customer);

        $this->assertDatabaseHas('customers', $customer);

        $this->post('/a/customers', $customer)
            ->assertSessionHasErrors('name');

        $this->assertDatabaseCount('customers', 1);
    }
}
