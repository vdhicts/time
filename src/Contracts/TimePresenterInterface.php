<?php

namespace Vdhicts\Time\Contracts;

interface TimePresenterInterface
{
    public function asNumericalTime(bool $showSeconds = false): string;
    public function asReadableTime(): string;
}
