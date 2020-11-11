<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Depot;
use App\Models\LocomotiveApplication;
use App\Models\Purpose;
use App\Models\User;

class DashboardController extends Controller
{
    public function show()
    {
        $usersInfo = User::getUsersInfo();
        $locAppsInfo = LocomotiveApplication::getLocAppsInfo();

        $customersCount = Customer::count();
        $purposesCount = Purpose::count();
        $depotsCount = Depot::count();

        return view('backend.dashboard', compact('usersInfo', 'locAppsInfo', 'customersCount', 'purposesCount', 'depotsCount'));
    }
}
