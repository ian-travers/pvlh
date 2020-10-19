<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Customer;

class CustomersController extends Controller
{
    public function index()
    {
        $customers = Customer::orderBy('id')->paginate(10);

        return view('backend.customers.index', compact('customers'));
    }

    public function create()
    {
        return view('backend.customers.create', ['customer' => $customer = new Customer()]);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store()
    {
        $this->validate(request(), [
            'name' => 'required|string|max:40|unique:customers',
        ]);

        Customer::create([
            'name' => request('name'),
        ]);

        return redirect()->route('backend.customers');
    }

    public function edit(Customer $customer)
    {
        session()->put('url.intended', url()->previous());

        return view('backend.customers.edit', compact('customer'));
    }

    /**
     * @param Customer $customer
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Customer $customer)
    {
        $this->validate(request(), [
            'name' => 'required|string|max:40|unique:customers,name,' . $customer->id,
        ]);

        $customer->update([
            'name' => request('name'),
        ]);

        return redirect()->intended();
    }

    /**
     * @param Customer $customer
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function remove(Customer $customer)
    {
        session()->put('url.intended', url()->previous());

        $customer->delete();

        return redirect()->intended();
    }
}
