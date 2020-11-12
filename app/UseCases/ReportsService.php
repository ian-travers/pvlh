<?php

namespace App\UseCases;

use App\Reports\MonthlyReport;

class ReportsService
{
    public function monthlyReport(int $sections, int $month, int $year)
    {
        return (new MonthlyReport($sections, $month, $year))->generateData();
    }
}
