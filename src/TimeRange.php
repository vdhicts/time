<?php

namespace Vdhicts\Dicms\Time;

use Vdhicts\Dicms\Time\Contracts;

class TimeRange implements Contracts\TimeRange
{
    private Contracts\Time $start;
    private Contracts\Time $end;

    public function __construct(Contracts\Time $start, Contracts\Time $end)
    {
        $this->start = $start;
        $this->end = $end;
    }

    public function getStart(): Contracts\Time
    {
        return $this->start;
    }

    public function getEnd(): Contracts\Time
    {
        return $this->end;
    }

    /**
     * Determines if the time is in between or equals to the start and end of this time range.
     */
    public function isTimeInRange(Contracts\Time $time): bool
    {
        $startIsAfterOrEqualTo = $time->isAfterOrEqualTo($this->start);
        $endIsBeforeOrEqualTo = $time->isBeforeOrEqualTo($this->end);

        return ($startIsAfterOrEqualTo && $endIsBeforeOrEqualTo);
    }

    /**
     * Determine if the time ranges are overlapping each other.
     */
    public function isTimeRangeOverlapping(Contracts\TimeRange $timeRange): bool
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
