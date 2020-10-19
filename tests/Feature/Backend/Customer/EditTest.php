<?php

namespace Tests\Feature\Backend\Customer;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class EditTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function unauthorized_users_cannot_delete_a_customer()
    {
        $this->patch('/a/customers/1')
            ->assertRedirect('/login');

        Customer::create([
            'name' => 'PMS'
        ]);

        $this->signIn();

        $this->patch('/a/customers/1')
            ->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /** @test */
    function authorized_users_can_edit_a_customer()
    {
        /** @var Customer $customer */
        $customer = Customer::create([
            'name' => 'PMS'
        ]);

        $this->signIn(User::factory()->admin()->create());

        $data = [
            'name' => 'UPD',
        ];

        $this->patch("/a/customers/{$customer->id}", $data);

        $this->assertEquals('UPD', $customer->fresh()->name);
    }

    /** @test */
    function editing_customer_name_must_be_unique()
    {
        Customer::create([
            'name' => 'solid'
        ]);

        /** @var Customer $customer */
        $customer = Customer::create([
            'name' => 'PMS'
        ]);

        $this->signIn(User::factory()->admin()->create());

        $data = [
            'name' => 'solid',
        ];

        $this->patch("/a/customers/{$customer->id}", $data)
            ->assertSessionHasErrors('name');
    }
}
