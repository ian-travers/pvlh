<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Response;

class UsersController extends Controller
{
    public function index()
    {
        return view('backend.users.index', ['data' => User::paginate(10)]);
    }

    public function create()
    {
        $user = new User();
        $roles = User::roles();

        return view('backend.users.create', compact('user', 'roles'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store()
    {
        request()['roles'] = array_keys(User::roles());

        $data = $this->validate(request(), [
            'name' => 'required|string|max:255',
            'role' => 'required|in_array:roles.*',
            'position' => 'required|string|max:50',
            'email' => 'required|string|email:filter|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        User::createByAdmin($data);
        // TODO: Perhaps here it needs to notify the created user via email for example

        return redirect()->route('backend.users');
    }

    public function edit(User $user)
    {
        $roles = User::roles();

        session()->put('url.intended', url()->previous());

        return view('backend.users.edit', compact('user', 'roles'));
    }

    /**
     * @param User $user
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(User $user)
    {
        request()['roles'] = array_keys(User::roles());

        $data = $this->validate(request(), [
            'name' => 'required|string|max:255',
            'role' => 'required|in_array:roles.*',
            'position' => 'required|string|max:50',
            'email' => 'required|string|email:filter|max:255|unique:users,email,' . $user->id,
        ]);

        $user->editByAdmin($data);

        return redirect()->intended();
    }

    public function toggleBrowserNotification(User $user)
    {
        $user->toggleBrowserNotification();

        if (request()->wantsJson()) {
            return $user->hasBrowserNotifications()
                ? response([
                    'title' => 'Выполнено!',
                    'message' => 'Теперь пользователь будет получать уведомления в браузере.',
                ])
                : response([
                    'title' => 'Выполнено!',
                    'message' => 'Теперь пользователь не будет получать уведомления в браузере.',
                ]);
        }

        return back();
    }

    public function toggleEmailNotification(User $user)
    {
        $user->toggleEmailNotification();

        if (request()->wantsJson()) {
            return $user->hasEmailNotifications()
                ? response([
                    'title' => 'Выполнено!',
                    'message' => 'Теперь пользователь будет получать уведомления по электронной почте.',
                ])
                : response([
                    'title' => 'Выполнено!',
                    'message' => 'Теперь пользователь не будет получать уведомления по электронной почте.',
                ]);
        }

        return back();
    }

    /**
     * @param User $user
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function changePassword()
    {
        $this->validate(request(), [
            'userId' => 'required',
            'password' => 'required|string|min:8|regex:/^\S*$/u',
        ]);

        $user = User::findOrFail(request('userId'));
        $user->setPassword(request('password'));

        if (request()->wantsJson()) {
            return response([
                'title' => 'Выполнено!',
                'message' => 'Пароль изменен успешно.',
            ]);
        }

        return back();
    }

    public function verify()
    {
        /** @var User $user */
        $user = User::findOrFail(request('userId'));

        $user->markEmailAsVerified();

        return response(['title' => 'Выполнено!', 'message' => 'Пользователь успешно верифицирован.']);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|Response
     * @throws \Exception
     */
    public function remove()
    {
        /** @var User $user */
        $user = User::findOrFail(request('userId'));

        if ($user->isCanBeDeleted()) {
            $user->delete();

            return response(['title' => 'Выполнено!', 'message' => 'Пользователь удален успешно.']);
        }

        return response(['title' => 'Ошибка!', 'message' => 'Невозможно удалить учетную запись. Есть связанные объекты.'], Response::HTTP_CONFLICT);
    }
}
