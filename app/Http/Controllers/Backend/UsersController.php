<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;

class UsersController extends Controller
{
    /**
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store()
    {
        $data = $this->validate(request(), [
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:50',
            'email' => 'required|string|email:filter|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        User::createByAdmin($data);
        // TODO: Perhaps here it needs to notify the created user via email for example

        return back();
    }
}
