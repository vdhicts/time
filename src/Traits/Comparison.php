<?php

namespace Vdhicts\Time\Traits;

use Vdhicts\Time\Contracts\TimeInterface;

trait Comparison
{
    public function isEqualTo(TimeInterface $time): bool
    {
        return $this->toString() === $time->toString();
    }

    public function isBefore(TimeInterface $time): bool
    {
        return strtotime($this->toString()) < strtotime($time->toString());
    }

    public function isBeforeOrEqualTo(TimeInterface $time): bool
    {
        if ($this->isEqualTo($time)) {
            return true;
        }

        return $this->isBefore($time);
    }

    public function isAfter(TimeInterface $time): bool
    {
        return strtotime($this->toString()) > strtotime($time->toString());
    }

    public function isAfterOrEqualTo(TimeInterface $time): bool
    {
        if ($this->isEqualTo($time)) {
            return true;
        }

        return $this->isAfter($time);
    }
}
