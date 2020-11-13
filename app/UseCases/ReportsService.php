<?php

namespace App\UseCases;

use App\Reports\MonthlyReport;

class ReportsService
{
    public function monthlyReport(int $sections, int $month, int $year)
    {
        return (new MonthlyReport($sections, $month, $year))->datesReport();
    }

    public function monthlySummaryMatrixReport(int $sections, int $month, int $year)
    {
        return (new MonthlyReport($sections, $month, $year))->summaryMatrix();
    }

    public function monthlySummaryDepots(int $sections, int $month, int $year)
    {
        return (new MonthlyReport($sections, $month, $year))->summaryByDepots();
    }
}
