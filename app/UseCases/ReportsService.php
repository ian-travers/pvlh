<?php

namespace App\UseCases;

class ReportsService
{
    public function monthlyReport()
    {
        return request()->all();
    }
}
