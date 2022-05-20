<?php

namespace Vdhicts\Time\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Vdhicts\Time\Exceptions\TimeException;
use Vdhicts\Time\Time;
use Vdhicts\Time\TimePresenter;

class TimeTest extends TestCase
{
    public function testClassExists(): void
    {
        $this->assertTrue(class_exists(Time::class));
    }

    public function testInitialisation(): void
    {
        $time = new Time();

        $this->assertInstanceOf(Time::class, $time);
    }

    public function testGetters(): void
    {
        $hours = 14;
        $minutes = 30;
        $seconds = 15;

        $time = new Time($hours, $minutes, $seconds);

        $this->assertSame($hours, $time->getHours());
        $this->assertSame($minutes, $time->getMinutes());
        $this->assertSame($seconds, $time->getSeconds());
    }

    public function testSetHoursException(): void
    {
        $this->expectException(TimeException::class);

        $time = new Time(30);
    }

    public function testSetMinutesException(): void
    {
        $this->expectException(TimeException::class);

        $time = new Time(14, 89);
    }

    public function testSetSecondsException(): void
    {
        $this->expectException(TimeException::class);

        $time = new Time(14, 30, 89);
    }

    public function testComparison(): void
    {
        $time = new Time(10, 30, 10);
        $anotherTime = new Time(17, 10, 30);

        $this->assertFalse($time->isEqualTo($anotherTime));

        $this->assertTrue($time->isBefore($anotherTime));
        $this->assertTrue($time->isBeforeOrEqualTo($anotherTime));
        $this->assertFalse($time->isAfter($anotherTime));
        $this->assertFalse($time->isAfterOrEqualTo($anotherTime));

        $this->assertFalse($anotherTime->isBefore($time));
        $this->assertFalse($anotherTime->isBeforeOrEqualTo($time));
        $this->assertTrue($anotherTime->isAfter($time));
        $this->assertTrue($anotherTime->isAfterOrEqualTo($time));
    }

    public function testConversion(): void
    {
        $hours = 14;
        $minutes = 30;
        $seconds = 15;

        $time = new Time($hours, $minutes, $seconds);

        $this->assertSame('14:30:15', $time->toString());
        $this->assertSame('14:30:15', (string)$time);
    }

    public function testClone(): void
    {
        $hours = 14;
        $minutes = 30;
        $seconds = 15;

        $time = new Time($hours, $minutes, $seconds);

        $clonedTime = $time
            ->clone()
            ->setHours($hours - 2)
            ->setMinutes($minutes - 5)
            ->setSeconds($seconds - 10);
        $this->assertSame($hours - 2, $clonedTime->getHours());
        $this->assertSame($hours, $time->getHours());
        $this->assertSame($minutes - 5, $clonedTime->getMinutes());
        $this->assertSame($minutes, $time->getMinutes());
        $this->assertSame($seconds - 10, $clonedTime->getSeconds());
        $this->assertSame($seconds, $time->getSeconds());
    }

    public function testDuration(): void
    {
        $time = new Time(2, 30, 45);

        $this->assertSame(9045, $time->durationInSeconds());
        $this->assertSame(150.75, $time->durationInMinutes());
        $this->assertSame(2.5125, $time->durationInHours());
    }

    public function testRounding(): void
    {
        $time = new Time(2, 29, 45);

        $this->assertSame('2:30:00', $time->roundNatural()->toString());
        $this->assertSame('2:30:00', $time->roundUp()->toString());
        $this->assertSame('2:25:00', $time->roundDown()->toString());

        $time = new Time(2, 21, 45);

        $this->assertSame('2:20:00', $time->roundNatural(10)->toString());
        $this->assertSame('2:30:00', $time->roundUp(10)->toString());
        $this->assertSame('2:20:00', $time->roundDown(10)->toString());

        $time = new Time(2, 21, 59);

        $this->assertSame('2:22:00', $time->roundNatural(5, true)->toString());
        $this->assertSame('2:22:00', $time->roundUp(5, true)->toString());
        $this->assertSame('2:21:55', $time->roundDown(5, true)->toString());

        $time = new Time(2, 21, 33);

        $this->assertSame('2:21:30', $time->roundNatural(15, true)->toString());
        $this->assertSame('2:21:45', $time->roundUp(15, true)->toString());
        $this->assertSame('2:21:30', $time->roundDown(15, true)->toString());
    }

    public function testDifference(): void
    {
        $timeStart = new Time(10, 30);
        $timeEnd = new Time(14);

        $timeDiff = $timeEnd->diff($timeStart);

        $this->assertInstanceOf(Time::class, $timeDiff);
        $this->assertSame(3, $timeDiff->getHours());
        $this->assertSame(30, $timeDiff->getMinutes());

        $this->assertSame(-3.5, $timeEnd->diffInHours($timeStart));
        $this->assertSame(3.5, $timeStart->diffInHours($timeEnd));
        $this->assertSame(-210, (int)$timeEnd->diffInMinutes($timeStart));
        $this->assertSame(210, (int)$timeStart->diffInMinutes($timeEnd));
        $this->assertSame(-12600, $timeEnd->diffInSeconds($timeStart));
        $this->assertSame(12600, $timeStart->diffInSeconds($timeEnd));
    }

    public function testPresenter(): void
    {
        $time = new Time(2, 30, 45);

        $presenter = $time->present();

        $this->assertInstanceOf(TimePresenter::class, $presenter);
    }
}
