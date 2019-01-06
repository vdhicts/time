<?php

namespace Vdhicts\Dicms\Time\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Vdhicts\Dicms\Time\Time;
use Vdhicts\Dicms\Time\TimeRange;

class TimeRangeTest extends TestCase
{
    public function testClassExists()
    {
        $this->assertTrue(class_exists(TimeRange::class));
    }

    public function testInitialisation()
    {
        $time = new Time(10);
        $anotherTime = new Time(17);
        $timeRange = new TimeRange($time, $anotherTime);

        $this->assertInstanceOf(TimeRange::class, $timeRange);
    }

    public function testGetters()
    {
        $time = new Time(10);
        $anotherTime = new Time(17);
        $timeRange = new TimeRange($time, $anotherTime);

        $this->assertSame($time->toString(), $timeRange->getStart()->toString());
        $this->assertSame($anotherTime->toString(), $timeRange->getEnd()->toString());
    }

    public function testInTimeRange()
    {
        $time = new Time(10);
        $anotherTime = new Time(17);
        $timeRange = new TimeRange($time, $anotherTime);

        $timeInRange = new Time(15, 30, 30);
        $timeNotInRange = new Time(18);

        $this->assertTrue($timeRange->isTimeInRange($timeInRange));
        $this->assertFalse($timeRange->isTimeInRange($timeNotInRange));
    }

    public function testRangeOverlapping()
    {
        $firstStartTime = new Time(10, 15, 15);
        $firstEndTime = new Time(17, 45, 45);
        $firstTimeRange = new TimeRange($firstStartTime, $firstEndTime);

        $secondStartTime = new Time(12, 30, 30);
        $secondEndTime = new Time(20, 15, 15);
        $secondTimeRange = new TimeRange($secondStartTime, $secondEndTime);

        $this->assertTrue($firstTimeRange->isTimeRangeOverlapping($secondTimeRange));
        $this->assertTrue($secondTimeRange->isTimeRangeOverlapping($firstTimeRange));

        $thirdStartTime = new Time(17, 50, 30);
        $thirdEndTime = new Time(23, 30, 30);
        $thirdTimeRange = new TimeRange($thirdStartTime, $thirdEndTime);

        $this->assertFalse($firstTimeRange->isTimeRangeOverlapping($thirdTimeRange));
        $this->assertTrue($secondTimeRange->isTimeRangeOverlapping($thirdTimeRange));
    }
}
