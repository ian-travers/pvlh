<?php

namespace App\Http\Controllers;

use App\UseCases\ReportsService;

class ReportsController extends Controller
{
    protected $reportsService;

    public function __construct(ReportsService $reportsService)
    {
        $this->reportsService = $reportsService;
    }

    public function monthlyReport()
    {
        return $this->reportsService->monthlyReport();
    }
}
