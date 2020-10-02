<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;

class ProfileController extends Controller
{
    public function show()
    {
        return view('user.profile', ['user' => auth()->user()]);
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update()
    {
        $data = $this->validate(request(), [
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:50',
            'is_browser_notified' => 'required|boolean',
            'is_email_notified' => 'required|boolean',
        ]);

        /** @var User $user */
        $user = auth()->user();

        $user->update($data);

        if (request()->wantsJson()) {
            return response([
                'title' => 'Успех!',
                'message' => 'Сохранено.',
            ]);
        }

        return back();
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function changeEmail()
    {
        /** @var User $user */
        $user = auth()->user();

        $this->validate(request(), [
            'email' => 'required|string|email:filter|max:255|unique:users,email,' . $user->id,
        ]);

        if (request('email') !== $user->email) {
            $user->update([
                'email' => request('email'),
            ]);

            if (request()->wantsJson()) {
                return response([
                    'title' => 'Успех!',
                    'message' => 'Адрес email изменен.',
                ]);
            }
        }

        return back();
    }
}
