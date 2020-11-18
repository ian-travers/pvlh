<?php

namespace Tests\Unit;

use App\ReadModel\Calendar\Query\Query;
use Tests\TestCase;

class QueryTest extends TestCase
{
    /** @test */
    function it_return_valid_next()
    {
        $query = new Query(2020, 12);

        $this->assertEquals('2021', $query->nextYear());
        $this->assertEquals('1', $query->nextMonth());

        $query = new Query(2020, 11);

        $this->assertEquals('2020', $query->nextYear());
        $this->assertEquals('12', $query->nextMonth());
    }

    /** @test */
    function it_return_valid_previous()
    {
        $query = new Query(2020, 11);

        $this->assertEquals('2020', $query->previousYear());
        $this->assertEquals('10', $query->previousMonth());

        $query = new Query(2021, 1);

        $this->assertEquals('2020', $query->previousYear());
        $this->assertEquals('12', $query->previousMonth());
    }
}
