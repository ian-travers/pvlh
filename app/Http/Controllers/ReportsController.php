<?php

namespace App\Http\Controllers;

use App\Models\Depot;
use App\UseCases\ReportsService;

class ReportsController extends Controller
{
    protected $reportsService;

    public function __construct(ReportsService $reportsService)
    {
        $this->reportsService = $reportsService;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Validation\ValidationException
     */
    public function monthlyReport()
    {
        $this->validate(request(), [
            'sections' => 'required|int|min:1|max:2',
            'month' => 'required|int|min:1|max:12',
            'year' => 'required|int|min:2020',
        ]);

        $report = $this->reportsService->monthlyReport(request('sections'), request('month'), request('year'));

        return view('reports.monthly.show', [
            'report' => $report,
            'summaryMatrix' => $this->reportsService->monthlySummaryMatrixReport(request('sections'), request('month'), request('year')),
            'summaryDepots' => $this->reportsService->monthlySummaryDepots(request('sections'), request('month'), request('year')),
            'sections' => request('sections'),
            'month' => monthName(request('month')),
            'year' => request('year'),
            'customersCount' => count($report[1]) - 1,
            'customersNames' => array_keys(array_slice($report[1], 0, -1)),
            'depotsNames' => Depot::orderBy('id')->pluck('name')->toArray(),
        ]);
    }
}
