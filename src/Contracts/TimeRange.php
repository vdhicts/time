<?php

namespace Vdhicts\Dicms\Time\Contracts;

interface TimeRange
{
    public function getStart(): Time;
    public function getEnd(): Time;

    public function isTimeInRange(Time $time): bool;
    public function isTimeRangeOverlapping(TimeRange $timeRange): bool;
}
