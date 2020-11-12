<?php

namespace App\Reports;

use App\Models\Customer;
use DB;

class MonthlyReport
{
    protected $sections;
    protected $month;
    protected $year;

    public function __construct(int $sections, int $month, int $year)
    {
        $this->sections = $sections;
        $this->month = $month;
        $this->year = $year;
    }

    public function generateData(): array
    {
        for ($day = 1; $day <= $this->daysInMonth(); $day++) {
            $data[$day] = $this->getDayData($day);
            $data[$day]['depots_total'] = $this->getDayDataGroupedByDepot($day);
        }

        return $data ?? [];
    }

    protected function getDayData(int $day): array
    {
        foreach ($this->customers() as $id => $name) {
            $data[$name] = $this->getDayDataByCustomer($day, $id);
        }

        return $data ?? [];
    }

    protected function getDayDataByCustomer(int $day, int $customerId)
    {
        $data = DB::select('
select `count`, hours,  depots.name as depot, purposes.name as purpose
from locomotive_applications
join depots on depot_id = depots.id
join purposes on purpose_id = purposes.id
where customer_id = :id
    and DAY(on_date) = :day
    and MONTH(on_date) = :month
    and YEAR(on_date) = :year
    and sections = :sections
    and is_nodn = 1
    and is_nodt = 1
    and is_nodshp = 1
             ',
            [
                'id' => $customerId,
                'day' => $day,
                'month' => $this->month,
                'year' => $this->year,
                'sections' => $this->sections,
            ]);

        // Sum of count and hours
        $data['total'] = [
            'count' => array_sum(array_column($data, 'count')),
            'hours' => array_sum(array_column($data, 'hours')),
        ];

        return $data;
    }

    protected function getDayDataGroupedByDepot(int $day)
    {
        return DB::select('
select depots.name as depot, sum(`count`) as `count`, sum(hours) as hours
from locomotive_applications
join depots on depot_id = depots.id
where DAY(on_date) = :day
    and MONTH(on_date) = :month
    and YEAR(on_date) = :year
    and sections = :sections
    and is_nodn = 1
    and is_nodt = 1
    and is_nodshp = 1
group by depot_id
order by depot_id
        ',
            [
                'day' => $day,
                'month' => $this->month,
                'year' => $this->year,
                'sections' => $this->sections,
            ]);
    }

    protected function daysInMonth(): int
    {
        return cal_days_in_month(CAL_GREGORIAN, $this->month, $this->year);
    }

    protected function customers()
    {
        return Customer::orderBy('id')->pluck('name', 'id');
    }
}
