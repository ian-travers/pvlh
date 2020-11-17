<?php

namespace App\Http\Controllers;

use App\ReadModel\Calendar\CalendarFetcher;
use App\ReadModel\Calendar\Query\Query;

class CalendarController extends Controller
{
    public function show()
    {
        $now = new \DateTimeImmutable();

        $query = Query::createFromDate($now);

        $calendar = new CalendarFetcher($query);

        $calendarData = $calendar->byMonth();

        return view('calendar.show', [
            'monthAsText' => mb_convert_case(monthName($calendarData->month->format('n')), MB_CASE_TITLE_SIMPLE),
            'yearAsText' => $calendarData->month->format('Y'),
            'dates' => iterator_to_array(new \DatePeriod($calendarData->start, new \DateInterval('P1D'), $calendarData->end)),
            'now' => now(),
            'currentMonth' => $calendarData->month
        ]);
    }
}
