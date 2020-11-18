<?php

namespace App\ReadModel\Calendar\Query;

class Query
{
    public $year;
    public $month;
    private $current;

    public function __construct(int $year, int $month)
    {
        $this->year = $year;
        $this->month = $month;
        $this->current = strtotime($year . '-' . $month . '-01');
    }

    public static function createFromDate(\DateTimeImmutable $date): self
    {
        return new self((int)$date->format('Y'), (int)$date->format('m'));
    }

    public function nextMonth(): string
    {
        return date('n', strtotime('first day of next month', $this->current));
    }

    public function nextYear(): string
    {
        return date('Y', strtotime('first day of next month', $this->current));
    }

    public function previousMonth(): string
    {
        return date('n', strtotime('first day of previous month', $this->current));
    }

    public function previousYear(): string
    {
        return date('Y', strtotime('first day of previous month', $this->current));
    }
}
