<?php

namespace Vdhicts\Dicms\Time;

use Vdhicts\Dicms\Time\Contracts;
use Vdhicts\Dicms\Time\Exceptions\TimeException;

class Time implements Contracts\Time
{
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

    /**
     * @throws TimeException
     */
    public static function createFromString(string $value): self
    {
        $timestamp = strtotime($value);
        if (! $timestamp) {
            throw TimeException::unableToCreateFromString($value);
        }

        return self::createFromTimestamp($timestamp);
    }

    /**
     * @throws TimeException
     */
    public static function createFromTimestamp(int $timestamp): self
    {
        $hours = (int)date('H', $timestamp);
        $minutes = (int)date('i', $timestamp);
        $seconds = (int)date('s', $timestamp);

        return (new self())
            ->setHours($hours)
            ->setMinutes($minutes)
            ->setSeconds($seconds);
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

    public function isEqualTo(Contracts\Time $time): bool
    {
        return $this->toString() === $time->toString();
    }

    public function isBefore(Contracts\Time $time): bool
    {
        return strtotime($this->toString()) < strtotime($time->toString());
    }

    public function isBeforeOrEqualTo(Contracts\Time $time): bool
    {
        return $this->isEqualTo($time) || $this->isBefore($time);
    }

    public function isAfter(Contracts\Time $time): bool
    {
        return strtotime($this->toString()) > strtotime($time->toString());
    }

    public function isAfterOrEqualTo(Contracts\Time $time): bool
    {
        return $this->isEqualTo($time) || $this->isAfter($time);
    }

    /**
     * Returns the time part padded with zeros.
     */
    private function padTime(int $value): string
    {
        return str_pad((string)$value, 2, '0', STR_PAD_LEFT);
    }

    /**
     * Returns the textual presentation of the time.
     */
    public function show(bool $hours = true, bool $minutes = true, bool $seconds = false): string
    {
        $parts = [];
        if ($hours) {
            $parts[] = $this->padTime($this->getHours());
        }
        if ($minutes) {
            $parts[] = $this->padTime($this->getMinutes());
        }
        if ($seconds) {
            $parts[] = $this->padTime($this->getSeconds());
        }

        return implode(':', $parts);
    }

    public function toString(): string
    {
        return sprintf(
            '%s:%s:%s',
            $this->padTime($this->getHours()),
            $this->padTime($this->getMinutes()),
            $this->padTime($this->getSeconds())
        );
    }

    public function __toString(): string
    {
        return $this->toString();
    }
}
