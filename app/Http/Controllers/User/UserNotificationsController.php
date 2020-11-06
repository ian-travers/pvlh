<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Notifications\DatabaseNotification;

class UserNotificationsController extends Controller
{
    public function index()
    {
        if (request()->wantsJson()) {
            return auth()->user()->unreadNotifications->take(10);
        }

        $notifications = auth()->user()->notifications()->paginate(10);

        return view('user.notifications', compact('notifications'));
    }

    public function remove(string $notificationId)
    {
        auth()->user()->notifications()->findOrFail($notificationId)->markAsRead();
    }

    public function toggleRead(DatabaseNotification $notification)
    {
        session()->put('url.intended', url()->previous());

        $notification->read() ? $notification->markAsUnread() : $notification->markAsRead();

        return redirect()->intended()->with('flash', json_encode([
            'title' => 'Успех',
            'message' => $notification->read()
                ? 'Уведомление отмечено как прочитанное'
                : 'Снята отметка о прочтении уведомления'
        ]));
    }

    /**
     * @param DatabaseNotification $notification
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(DatabaseNotification $notification)
    {
        session()->put('url.intended', url()->previous());

        $notification->delete();

        return redirect()->intended()->with('flash', json_encode([
            'title' => 'Успех',
            'message' => 'Уведомление удалено из системы'
        ]));
    }
}
