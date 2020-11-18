<?php

namespace App\Http\Controllers;

use App\ReadModel\Calendar\CalendarFetcher;
use App\ReadModel\Calendar\Query\Query;
use Illuminate\Validation\ValidationException;

class CalendarController extends Controller
{
    public function show()
    {
        try {
            $this->validate(request(), [
                'm' => 'nullable|int|min:1|max:12',
                'y' => 'nullable|int|min:2020',
            ]);
        } catch (ValidationException $e) {
            return back()->with('flash', json_encode([
                'level' => 'error',
                'title' => 'Ошибка выбора периода!',
                'message' => 'Месяц или год календаря выбраны неверно, либо указан период ранее 2020 года.'
            ]));
        }

        $query = (request()->has('m') && request()->has('y'))
            ? new Query(request('y'), request('m'))
            : Query::createFromDate(new \DateTimeImmutable());

//        $now = new \DateTimeImmutable();
//
//        $query = Query::createFromDate($now);
        $calendar = new CalendarFetcher($query);

        $calendarData = $calendar->byMonth();

        return view('calendar.show', [
            'monthAsText' => mb_convert_case(monthName($calendarData->month->format('n')), MB_CASE_TITLE_SIMPLE),
            'yearAsText' => $calendarData->month->format('Y'),
            'dates' => iterator_to_array(new \DatePeriod($calendarData->start, new \DateInterval('P1D'), $calendarData->end)),
            'now' => now(),
            'currentMonth' => $calendarData->month,
            'previousLink' => '/calendar?m=' . $query->previousMonth() . '&y=' . $query->previousYear(),
            'nextLink' => '/calendar?m=' . $query->nextMonth() . '&y=' . $query->nextYear(),
        ]);
    }
}
