<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;

class DashboardController extends Controller
{
    public function show()
    {
        $usersInfo = User::getUsersInfo();

        return view('backend.dashboard', compact('usersInfo'));
    }
}
