<?php

namespace App\ReadModel\Calendar;

use App\ReadModel\Calendar\Query\Query;

class CalendarFetcher
{
    private $query;

    public function __construct(Query $query)
    {
        $this->query = $query;
    }

    public function byMonth()
    {
        $month = new \DateTimeImmutable($this->query->year . '-' . $this->query->month . '-01');
        $start = self::calcFirstDayOfWeek($month)->setTime(0, 0);

        // Add 5 rows per 7 days + 1 day
        $lastCalDay = $start->modify('+35 days');

        // It must be between less then 28 when we have 5 rows in the calendar sheet
        // Otherwise we need to add one more row to the calendar sheet
        (int)$lastCalDay->format('d') > 28
            ? $end = $start->modify('+41 days')->setTime(23, 59, 59)
            : $end = $start->modify('+34 days')->setTime(23, 59, 59);

        return new CalendarData([], $start, $end, $month);
    }

    private static function calcFirstDayOfWeek(\DateTimeImmutable $date)
    {
        if ($date->format('w') === '0') {
            return $date->modify('-6 days');
        }

        return $date->modify('-' . ($date->format('w') - 1) . ' days');
    }
}
