<?php

namespace Vdhicts\Time\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Vdhicts\Time\Time;
use Vdhicts\Time\TimeRange;

class TimeRangeTest extends TestCase
{
    public function testClassExists(): void
    {
        $this->assertTrue(class_exists(TimeRange::class));
    }

    public function testInitialisation(): void
    {
        $time = new Time(10);
        $anotherTime = new Time(17);
        $timeRange = new TimeRange($time, $anotherTime);

        $this->assertInstanceOf(TimeRange::class, $timeRange);
    }

    public function testGetters(): void
    {
        $time = new Time(10);
        $anotherTime = new Time(17);
        $timeRange = new TimeRange($time, $anotherTime);

        $this->assertSame($time->toString(), $timeRange->getStart()->toString());
        $this->assertSame($anotherTime->toString(), $timeRange->getEnd()->toString());
    }

    public function testInTimeRange(): void
    {
        $time = new Time(10);
        $anotherTime = new Time(17);
        $timeRange = new TimeRange($time, $anotherTime);

        $timeInRange = new Time(15, 30, 30);
        $timeNotInRange = new Time(18);

        $this->assertTrue($timeRange->inRange($timeInRange));
        $this->assertFalse($timeRange->inRange($timeNotInRange));
    }

    public function testRangeOverlapping(): void
    {
        $firstStartTime = new Time(10, 15, 15);
        $firstEndTime = new Time(17, 45, 45);
        $firstTimeRange = new TimeRange($firstStartTime, $firstEndTime);

        $secondStartTime = new Time(12, 30, 30);
        $secondEndTime = new Time(20, 15, 15);
        $secondTimeRange = new TimeRange($secondStartTime, $secondEndTime);

        $this->assertTrue($firstTimeRange->isOverlapping($secondTimeRange));
        $this->assertTrue($secondTimeRange->isOverlapping($firstTimeRange));

        $thirdStartTime = new Time(17, 50, 30);
        $thirdEndTime = new Time(23, 30, 30);
        $thirdTimeRange = new TimeRange($thirdStartTime, $thirdEndTime);

        $this->assertFalse($firstTimeRange->isOverlapping($thirdTimeRange));
        $this->assertTrue($secondTimeRange->isOverlapping($thirdTimeRange));
    }

    public function testRangeDuration()
    {
        $startTime = new Time(12, 30, 30);
        $endTime = new Time(14, 45, 15);
        $timeRange = new TimeRange($startTime, $endTime);

        $duration = $timeRange->getRangeDuration();

        $this->assertInstanceOf(Time::class, $duration);
        $this->assertSame(2, $duration->getHours());
        $this->assertSame(14, $duration->getMinutes());
        $this->assertSame(45, $duration->getSeconds());
    }
}
