<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Customer;

class CustomersController extends Controller
{
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
