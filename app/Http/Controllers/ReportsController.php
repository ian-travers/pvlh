<?php

namespace App\Http\Controllers;

use App\Models\Depot;
use App\Reports\MonthlyReport;

class ReportsController extends Controller
{
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

        $reportModel = new MonthlyReport(request('sections'), request('month'), request('year'));
        $report = $reportModel->datesReport();

        return view('reports.monthly.show', [
            'report' => $report,
            'summaryMatrix' => $reportModel->summaryMatrix(),
            'summaryDepots' => $reportModel->summaryByDepots(),
            'sections' => request('sections'),
            'month' => monthName(request('month')),
            'year' => request('year'),
            'customersCount' => count($report[1]) - 1,
            'customersNames' => array_keys(array_slice($report[1], 0, -1)),
            'depotsNames' => Depot::orderBy('id')->pluck('name')->toArray(),
        ]);
    }
}
