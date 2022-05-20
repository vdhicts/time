<?php

namespace Vdhicts\Time;

use Vdhicts\Time\Contracts\TimePresenterInterface;

class TimePresenter implements TimePresenterInterface
{
    private Time $time;

    public function __construct(Time $time)
    {
        $this->time = $time;
    }

    public function asNumericalTime(bool $showSeconds = false): string
    {
        $hours = $this
            ->time
            ->getHours();
        $minutes = $this
            ->time
            ->getMinutes();
        $seconds = $this
            ->time
            ->getSeconds();

        return $showSeconds
            ? sprintf('%02d:%02d:%02d', $hours, $minutes / 60 * 100, $seconds / 60 * 100)
            : sprintf('%02d:%02d', $hours, $minutes / 60 * 100);
    }

    public function asReadableTime(bool $showSeconds = false): string
    {
        $hours = $this
            ->time
            ->getHours();
        $minutes = $this
            ->time
            ->getMinutes();
        $seconds = $this
            ->time
            ->getSeconds();

        return $showSeconds
            ? sprintf('%d:%02d:%02d', $hours, $minutes, $seconds)
            : sprintf('%d:%02d', $hours, $minutes);
    }
}
