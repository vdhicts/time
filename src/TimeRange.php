<?php

namespace Vdhicts\Time;

use Vdhicts\Time\Contracts\TimeInterface;
use Vdhicts\Time\Contracts\TimeRangeInterface;

class TimeRange implements TimeRangeInterface
{
    public function __construct(
        private readonly TimeInterface $start,
        private readonly TimeInterface $end,
    ) {
    }

    public function getStart(): TimeInterface
    {
        return $this->start;
    }

    public function getEnd(): TimeInterface
    {
        return $this->end;
    }

    /**
     * Determines if the time is in between or equals to the start and end of this time range.
     */
    public function inRange(TimeInterface $time): bool
    {
        $startIsAfterOrEqualTo = $time->isAfterOrEqualTo($this->start);
        $endIsBeforeOrEqualTo = $time->isBeforeOrEqualTo($this->end);

        return ($startIsAfterOrEqualTo && $endIsBeforeOrEqualTo);
    }

    /**
     * Determine if the time ranges are overlapping each other.
     */
    public function isOverlapping(TimeRangeInterface $timeRange): bool
    {
        $startIsBeforeOrEqualToEnd = $this
            ->getStart()
            ->isBeforeOrEqualTo($timeRange->getEnd());
        $endIsAfterOrEqualToStart = $this
            ->getEnd()
            ->isAfterOrEqualTo($timeRange->getStart());

        return ($startIsBeforeOrEqualToEnd && $endIsAfterOrEqualToStart);
    }

    /**
     * Returns the time object for the duration of the range.
     */
    public function getRangeDuration(): TimeInterface
    {
        return $this
            ->start
            ->diff($this->end);
    }
}
