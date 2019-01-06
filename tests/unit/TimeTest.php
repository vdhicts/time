<?php

namespace Vdhicts\Dicms\Time\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Vdhicts\Dicms\Time\Exceptions\TimeException;
use Vdhicts\Dicms\Time\Time;

class TimeTest extends TestCase
{
    public function testClassExists()
    {
        $this->assertTrue(class_exists(Time::class));
    }

    public function testInitialisation()
    {
        $time = new Time();

        $this->assertInstanceOf(Time::class, $time);
    }

    public function testGetters()
    {
        $hours = 14;
        $minutes = 30;
        $seconds = 15;

        $time = new Time($hours, $minutes, $seconds);

        $this->assertSame($hours, $time->getHours());
        $this->assertSame($minutes, $time->getMinutes());
        $this->assertSame($seconds, $time->getSeconds());
    }

    public function testSetHoursException()
    {
        $this->expectException(TimeException::class);

        $time = new Time(30);
    }

    public function testSetMinutesException()
    {
        $this->expectException(TimeException::class);

        $time = new Time(14, 89);
    }

    public function testSetSecondsException()
    {
        $this->expectException(TimeException::class);

        $time = new Time(14, 30, 89);
    }

    public function testComparison()
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

    public function testConversion()
    {
        $hours = 14;
        $minutes = 30;
        $seconds = 15;

        $time = new Time($hours, $minutes, $seconds);

        $this->assertSame('14:30:15', $time->toString());
        $this->assertSame('14:30:15', (string)$time);
    }

    public function testCreateFromString()
    {
        $hours = 14;
        $minutes = 30;
        $seconds = 15;

        $timeString = sprintf('%d:%d:%d', $hours, $minutes, $seconds);

        $time = Time::createFromString($timeString);

        $this->assertInstanceOf(Time::class, $time);
        $this->assertSame($hours, $time->getHours());
        $this->assertSame($minutes, $time->getMinutes());
        $this->assertSame($seconds, $time->getSeconds());
    }

    public function testCreateFromStringException()
    {
        $this->expectException(TimeException::class);

        Time::createFromString('abc');
    }

    public function testCreateFromTimestamp()
    {
        $hours = 14;
        $minutes = 30;
        $seconds = 15;

        $timestamp = strtotime(sprintf('%d:%d:%d', $hours, $minutes, $seconds));

        $time = Time::createFromTimestamp($timestamp);

        $this->assertInstanceOf(Time::class, $time);
        $this->assertSame($hours, $time->getHours());
        $this->assertSame($minutes, $time->getMinutes());
        $this->assertSame($seconds, $time->getSeconds());
    }
}
