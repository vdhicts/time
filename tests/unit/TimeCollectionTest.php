<?php

namespace Vdhicts\Dicms\Time\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Vdhicts\Dicms\Time\Time;
use Vdhicts\Dicms\Time\TimeCollection;

class TimeCollectionTestTest extends TestCase
{
    public function testClassExists()
    {
        $this->assertTrue(class_exists(TimeCollection::class));
    }

    public function testInitialisation()
    {
        $collection = new TimeCollection();

        $this->assertInstanceOf(TimeCollection::class, $collection);

        $times = [
            new Time(14, 30, 15),
            new Time(16, 50, 45),
        ];

        $collection = new TimeCollection($times);

        $this->assertInstanceOf(TimeCollection::class, $collection);
    }

    public function testContains()
    {
        $time = new Time(14, 30, 15);
        $anotherTime = new Time(16, 50, 45);
        $specialTime = new Time(10, 10, 10);

        $times = [$time, $anotherTime];

        $collection = new TimeCollection($times);

        $this->assertTrue($collection->contains($time));
        $this->assertTrue($collection->contains($anotherTime));
        $this->assertFalse($collection->contains($specialTime));
    }
}
