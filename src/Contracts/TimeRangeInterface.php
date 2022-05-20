<?php

namespace Vdhicts\Time\Contracts;

interface TimeRangeInterface
{
    public function getStart(): TimeInterface;
    public function getEnd(): TimeInterface;

    public function inRange(TimeInterface $time): bool;
    public function isOverlapping(TimeRangeInterface $timeRange): bool;
    public function getRangeDuration(): TimeInterface;
}
