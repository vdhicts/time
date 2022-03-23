<?php

namespace Vdhicts\Time\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Vdhicts\Time\Exceptions\TimeException;
use Vdhicts\Time\Time;
use Vdhicts\Time\TimeFactory;

class TimeFactoryTest extends TestCase
{
    public function testCreateFromString(): void
    {
        $hours = 14;
        $minutes = 30;
        $seconds = 15;

        $timeString = sprintf('%d:%d:%d', $hours, $minutes, $seconds);

        $time = TimeFactory::createFromString($timeString);

        $this->assertInstanceOf(Time::class, $time);
        $this->assertSame($hours, $time->getHours());
        $this->assertSame($minutes, $time->getMinutes());
        $this->assertSame($seconds, $time->getSeconds());
    }

    public function testCreateFromStringException(): void
    {
        $this->expectException(TimeException::class);

        TimeFactory::createFromString('abc');
    }

    public function testCreateFromTimestamp(): void
    {
        $hours = 14;
        $minutes = 30;
        $seconds = 15;

        $timestamp = strtotime(sprintf('%d:%d:%d', $hours, $minutes, $seconds));

        $time = TimeFactory::createFromTimestamp($timestamp);

        $this->assertInstanceOf(Time::class, $time);
        $this->assertSame($hours, $time->getHours());
        $this->assertSame($minutes, $time->getMinutes());
        $this->assertSame($seconds, $time->getSeconds());
    }

    public function testCreateFromSeconds(): void
    {
        $hours = 2;
        $minutes = 30;
        $seconds = 15;

        $time = TimeFactory::createFromDurationInSeconds($hours * 3600 + $minutes * 60 + $seconds);

        $this->assertInstanceOf(Time::class, $time);
        $this->assertSame($hours, $time->getHours());
        $this->assertSame($minutes, $time->getMinutes());
        $this->assertSame($seconds, $time->getSeconds());
    }

    public function testCreateFromMinutes(): void
    {
        $hours = 2;
        $minutes = 30;

        $time = TimeFactory::createFromDurationInMinutes($hours * 60 + $minutes);

        $this->assertInstanceOf(Time::class, $time);
        $this->assertSame($hours, $time->getHours());
        $this->assertSame($minutes, $time->getMinutes());
    }
}
