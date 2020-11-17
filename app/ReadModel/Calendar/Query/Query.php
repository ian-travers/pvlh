<?php

namespace App\ReadModel\Calendar\Query;

class Query
{
    public $year;
    public $month;

    public function __construct(int $year, int $month)
    {
        $this->year = $year;
        $this->month = $month;
    }

    public static function createFromDate(\DateTimeImmutable $date): self
    {
        return new self((int)$date->format('Y'), (int)$date->format('m'));
    }
}
