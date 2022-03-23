<?php

namespace Vdhicts\Time;

use Vdhicts\Time\Contracts\TimeInterface;
use Vdhicts\Time\Exceptions\TimeException;
use Vdhicts\Time\Traits\Cloneable;
use Vdhicts\Time\Traits\Comparison;
use Vdhicts\Time\Traits\Conversion;
use Vdhicts\Time\Traits\Difference;
use Vdhicts\Time\Traits\Duration;
use Vdhicts\Time\Traits\Rounding;

class Time implements TimeInterface
{
    use Cloneable;
    use Comparison;
    use Conversion;
    use Difference;
    use Duration;
    use Rounding;

    private int $hours = 0;
    private int $minutes = 0;
    private int $seconds = 0;

    /**
     * @throws TimeException
     */
    public function __construct(int $hours = 0, int $minutes = 0, int $seconds = 0)
    {
        $this->setHours($hours);
        $this->setMinutes($minutes);
        $this->setSeconds($seconds);
    }

    public function getHours(): int
    {
        return $this->hours;
    }

    /**
     * @throws TimeException
     */
    public function setHours(int $hours): self
    {
        if ($hours < 0 || $hours > 23) {
            throw TimeException::invalidHours($hours);
        }

        $this->hours = $hours;

        return $this;
    }

    public function getMinutes(): int
    {
        return $this->minutes;
    }

    /**
     * @throws TimeException
     */
    public function setMinutes(int $minutes): self
    {
        if ($minutes < 0 || $minutes > 59) {
            throw TimeException::invalidMinutes($minutes);
        }

        $this->minutes = $minutes;

        return $this;
    }

    public function getSeconds(): int
    {
        return $this->seconds;
    }

    /**
     * @throws TimeException
     */
    public function setSeconds(int $seconds): self
    {
        if ($seconds < 0 || $seconds > 59) {
            throw TimeException::invalidSeconds($seconds);
        }

        $this->seconds = $seconds;

        return $this;
    }
}
