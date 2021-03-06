<?php

namespace Tests\Unit;

use App\Models\LocomotiveApplication;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LocomotiveApplicationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_return_valid_sections_name()
    {
        $this->assertEquals('Односекционный', LocomotiveApplication::sectionsList()[1]);
        $this->assertEquals('Двухсекционный', LocomotiveApplication::sectionsList()[2]);
    }

    /** @test */
    function it_returns_valid_editable_status()
    {
        $locApp = LocomotiveApplication::factory()->create();

        $this->assertTrue($locApp->editable());

        $locApp->update([
            'is_nodt' => true,
        ]);

        $this->assertFalse($locApp->editable());
    }
}
