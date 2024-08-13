<?php

namespace Vdhicts\Time\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Vdhicts\Time\Time;
use Vdhicts\Time\TimeCollection;

class TimeCollectionTest extends TestCase
{
    public function testClassExists(): void
    {
        $this->assertTrue(class_exists(TimeCollection::class));
    }

    public function testInitialisation(): void
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

    public function testContains(): void
    {
        $time = new Time(14, 30, 15);
        $anotherTime = new Time(16, 50, 45);
        $specialTime = new Time(10, 10, 10);

        $times = [$time, $anotherTime];

        $timeCollection = new TimeCollection($times);

        $this->assertTrue($timeCollection->contains($time));
        $this->assertTrue($timeCollection->contains($anotherTime));
        $this->assertFalse($timeCollection->contains($specialTime));
    }
}
