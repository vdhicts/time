<?php

namespace Vdhicts\Time\Traits;

use Vdhicts\Time\TimePresenter;

trait Presentable
{
    public function present(): TimePresenter
    {
        return new TimePresenter($this);
    }

    public function toString(): string
    {
        return $this
            ->present()
            ->asReadableTime(true);
    }

    public function __toString(): string
    {
        return $this->toString();
    }
}
