<?php

namespace Vdhicts\Time;

use Vdhicts\Time\Contracts;

class TimeRange implements Contracts\TimeRangeInterface
{
    private Contracts\TimeInterface $start;
    private Contracts\TimeInterface $end;

    public function __construct(Contracts\TimeInterface $start, Contracts\TimeInterface $end)
    {
        $this->start = $start;
        $this->end = $end;
    }

    public function getStart(): Contracts\TimeInterface
    {
        return $this->start;
    }

    public function getEnd(): Contracts\TimeInterface
    {
        return $this->end;
    }

    /**
     * Determines if the time is in between or equals to the start and end of this time range.
     */
    public function inRange(Contracts\TimeInterface $time): bool
    {
        $startIsAfterOrEqualTo = $time->isAfterOrEqualTo($this->start);
        $endIsBeforeOrEqualTo = $time->isBeforeOrEqualTo($this->end);

        return ($startIsAfterOrEqualTo && $endIsBeforeOrEqualTo);
    }

    /**
     * Determine if the time ranges are overlapping each other.
     */
    public function isOverlapping(Contracts\TimeRangeInterface $timeRange): bool
    {
        $startIsBeforeOrEqualToEnd = $this
            ->getStart()
            ->isBeforeOrEqualTo($timeRange->getEnd());
        $endIsAfterOrEqualToStart = $this
            ->getEnd()
            ->isAfterOrEqualTo($timeRange->getStart());

        return ($startIsBeforeOrEqualToEnd && $endIsAfterOrEqualToStart);
    }
}
