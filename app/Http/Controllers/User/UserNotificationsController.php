<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class UserNotificationsController extends Controller
{
    public function index()
    {
        return auth()->user()->unreadNotifications;
    }

    public function remove(string $notificationId)
    {
        auth()->user()->notifications()->findOrFail($notificationId)->markAsRead();
    }
}
