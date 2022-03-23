<?php

namespace Vdhicts\Time\Traits;

use Vdhicts\Time\Contracts\TimeInterface;
use Vdhicts\Time\TimeFactory;

trait Difference
{
    public function diff(TimeInterface $time): TimeInterface
    {
        return TimeFactory::createFromDurationInSeconds(abs($this->diffInSeconds($time)));
    }

    public function diffInSeconds(TimeInterface $time): int
    {
        return $time->durationInSeconds() - $this->durationInSeconds();
    }

    public function diffInMinutes(TimeInterface $time): float
    {
        return $this->diffInSeconds($time) / 60;
    }

    public function diffInHours(TimeInterface $time): float
    {
        return $this->diffInSeconds($time) / 3600;
    }
}
