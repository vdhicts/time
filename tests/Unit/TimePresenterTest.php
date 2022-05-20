<?php

namespace Vdhicts\Time\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Vdhicts\Time\Time;
use Vdhicts\Time\TimePresenter;

class TimePresenterTest extends TestCase
{
    public function testClassExists(): void
    {
        $this->assertTrue(class_exists(TimePresenter::class));
    }

    public function testInitialisation(): void
    {
        $time = new Time(10);
        $timePresenter = new TimePresenter($time);

        $this->assertInstanceOf(TimePresenter::class, $timePresenter);
    }

    public function testNumerical(): void
    {
        $time = new Time(10, 30, 45);
        $timePresenter = new TimePresenter($time);

        $this->assertSame('10:50:75', $timePresenter->asNumericalTime(true));
        $this->assertSame('10:50', $timePresenter->asNumericalTime());
    }

    public function testReadable(): void
    {
        $time = new Time(10, 30, 45);
        $timePresenter = new TimePresenter($time);

        $this->assertSame('10:30:45', $timePresenter->asReadableTime(true));
        $this->assertSame('10:30', $timePresenter->asReadableTime());
    }
}
