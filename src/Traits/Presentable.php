<?php

namespace Vdhicts\Time\Traits;

trait Presentable
{
    public function toNumericalTime(bool $showSeconds = false): string
    {
        $hours = $this->getHours();
        $minutes = $this->getMinutes();
        $seconds = $this->getSeconds();

        return $showSeconds
            ? sprintf('%02d:%02d:%02d', $hours, $minutes / 60 * 100, $seconds / 60 * 100)
            : sprintf('%02d:%02d', $hours, $minutes / 60 * 100);
    }

    public function toReadableTime(bool $showSeconds = false): string
    {
        $hours = $this->getHours();
        $minutes = $this->getMinutes();
        $seconds = $this->getSeconds();

        return $showSeconds
            ? sprintf('%d:%02d:%02d', $hours, $minutes, $seconds)
            : sprintf('%d:%02d', $hours, $minutes);
    }

    public function toString(): string
    {
        return $this->toReadableTime(true);
    }

    public function __toString(): string
    {
        return $this->toString();
    }
}
