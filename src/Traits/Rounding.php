<?php

namespace Vdhicts\Time\Traits;

use Vdhicts\Time\Contracts\TimeInterface;
use Vdhicts\Time\Exceptions\TimeException;
use Vdhicts\Time\Time;
use Vdhicts\Time\TimeFactory;

trait Rounding
{
    /**
     * @throws TimeException
     */
    protected function round(string $method = 'natural', int $precision = 5, bool $roundSeconds = false): TimeInterface
    {
        $seconds = $this->durationInSeconds();

        return match ($method) {
            'up' => $roundSeconds
                ? TimeFactory::createFromDurationInSeconds((int)ceil($seconds / $precision) * $precision)
                : TimeFactory::createFromDurationInSeconds((int)ceil($seconds / ($precision * 60)) * ($precision * 60)),
            'down' => $roundSeconds
                ? TimeFactory::createFromDurationInSeconds((int)floor($seconds / $precision) * $precision)
                : TimeFactory::createFromDurationInSeconds((int)floor($seconds / ($precision * 60)) * ($precision * 60)),
            default => $roundSeconds
                ? TimeFactory::createFromDurationInSeconds((int)round($seconds / $precision) * $precision)
                : TimeFactory::createFromDurationInSeconds((int)round($seconds / ($precision * 60)) * ($precision * 60)),
        };
    }

    /**
     * @throws TimeException
     */
    public function roundUp(int $precision = 5, bool $roundSeconds = false): TimeInterface
    {
        return $this->round('up', $precision, $roundSeconds);
    }

    /**
     * @throws TimeException
     */
    public function roundNatural(int $precision = 5, bool $roundSeconds = false): TimeInterface
    {
        return $this->round('natural', $precision, $roundSeconds);
    }

    /**
     * @throws TimeException
     */
    public function roundDown(int $precision = 5, bool $roundSeconds = false): TimeInterface
    {
        return $this->round('down', $precision, $roundSeconds);
    }
}
