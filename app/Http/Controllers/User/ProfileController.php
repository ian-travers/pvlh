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
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $request['is_browser_notified'] = request()->has('is_browser_notified') ? true : false;
        $request['is_email_notified'] = request()->has('is_email_notified') ? true : false;

        $data = $this->validate($request, [
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:50',
            'is_browser_notified' => 'required|boolean',
            'is_email_notified' => 'required|boolean',
        ]);

        /** @var User $user */
        $user = auth()->user();

        $user->update($data);

        return back();
    }
}
