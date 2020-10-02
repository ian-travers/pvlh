<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show()
    {
        return view('user.profile', ['user' => auth()->user()]);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $data = $this->validate($request, [
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
                'title' => 'Успех',
                'message' => 'Сохранено.',
            ]);
        }

        return back();
    }
}
