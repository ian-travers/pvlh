<?php

namespace App\ReadModel\Calendar;

class CalendarData
{
    public $items;
    public $start;
    public $end;
    public $month;

    public function __construct(array $items, \DateTimeImmutable $start, \DateTimeImmutable $end, \DateTimeImmutable $month)
    {
        $this->items = $items;
        $this->start = $start;
        $this->end = $end;
        $this->month = $month;
    }
}
