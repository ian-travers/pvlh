<?php

namespace App\Http\Controllers;

class ReportsController extends Controller
{
    public function monthlyReport()
    {
        return request()->all();
    }
}
