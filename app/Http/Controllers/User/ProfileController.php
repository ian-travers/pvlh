<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Response;

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

    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function changePassword()
    {
        $this->validate(request(), [
            'password' => 'required|string|min:8|confirmed',
        ]);

        /** @var User $user */
        $user = auth()->user();

        $user->setPassword(request('password'));

        if (request()->wantsJson()) {
            return response([
                'title' => 'Успех!',
                'message' => 'Пароль изменен.',
            ]);
        }

        return back();
    }

    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function remove()
    {
        /** @var User $user */
        $user = auth()->user();

        if ($user->isCanBeDeleted()) {
            $this->validate(request(), [
                'passwordCheck' => 'required|password',
                'verifyPhrase' => 'required|regex:/^delete my account$/s'
            ]);

            auth()->logout();
            $user->delete();

            return response(['title' => 'Успех!', 'message' => 'Учетная запись удалена.']);
        }

        return response(['title' => 'Ошибка!', 'message' => 'Невозможно удалить учетную запись. Есть связанные объекты.'], Response::HTTP_CONFLICT);
    }
}
