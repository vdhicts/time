<?php

namespace Vdhicts\Time\Traits;

trait Duration
{
    public function durationInHours(): float
    {
        return
            $this->getHours() +
            $this->getMinutes() / 60 +
            $this->getSeconds() / 3600;
    }

    public function durationInMinutes(): float
    {
        return
            $this->getHours() * 60 +
            $this->getMinutes() +
            $this->getSeconds() / 60;
    }

    public function durationInSeconds(): int
    {
        return
            $this->getHours() * 3600 +
            $this->getMinutes() * 60 +
            $this->getSeconds();
    }
}
