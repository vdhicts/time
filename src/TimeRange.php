<?php

namespace Vdhicts\Dicms\Time;

use Vdhicts\Dicms\Time\Contracts;

class TimeRange implements Contracts\TimeRange
{
    /**
     * Holds the start time of the range.
     *
     * @var Contracts\Time
     */
    private $start;

    /**
     * Holds the end time of the range.
     *
     * @var Contracts\Time
     */
    private $end;

    /**
     * TimeRange constructor.
     *
     * @param Contracts\Time $start
     * @param Contracts\Time $end
     */
    public function __construct(Contracts\Time $start, Contracts\Time $end)
    {
        $this->start = $start;
        $this->end = $end;
    }

    /**
     * Returns the start time of the range.
     *
     * @return Contracts\Time
     */
    public function getStart(): Contracts\Time
    {
        return $this->start;
    }

    /**
     * Returns the end time of the range.
     *
     * @return Contracts\Time
     */
    public function getEnd(): Contracts\Time
    {
        return $this->end;
    }

    /**
     * Determines if the time is in between or equals to the start and end of this time range.
     *
     * @param Contracts\Time $time
     * @return bool
     */
    public function isTimeInRange(Contracts\Time $time): bool
    {
        $startIsAfterOrEqualTo = $time->isAfterOrEqualTo($this->start);
        $endIsBeforeOrEqualTo = $time->isBeforeOrEqualTo($this->end);

        return ($startIsAfterOrEqualTo && $endIsBeforeOrEqualTo);
    }

    /**
     * Determine if the time ranges are overlapping each other.
     *
     * @param Contracts\TimeRange $timeRange
     * @return bool
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
