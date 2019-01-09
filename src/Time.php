<?php

namespace Vdhicts\Dicms\Time;

use Vdhicts\Dicms\Time\Contracts;
use Vdhicts\Dicms\Time\Exceptions\TimeException;

class Time implements Contracts\Time
{
    /**
     * Holds the hours.
     *
     * @var int
     */
    private $hours = 0;

    /**
     * Holds the minutes.
     *
     * @var int
     */
    private $minutes = 0;

    /**
     * Holds the seconds.
     *
     * @var int
     */
    private $seconds = 0;

    /**
     * Time constructor.
     *
     * @param int $hours
     * @param int $minutes
     * @param int $seconds
     * @throws TimeException
     */
    public function __construct(int $hours = 0, int $minutes = 0, int $seconds = 0)
    {
        $this->setHours($hours);
        $this->setMinutes($minutes);
        $this->setSeconds($seconds);
    }

    /**
     * Creates a time value object from a textual presentation like 14:30:15.
     *
     * @param string $value
     * @return Time
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
     * Creates a time value object from a timestamp.
     *
     * @param int $timestamp
     * @return Time
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

    /**
     * Returns the hours.
     *
     * @return int
     */
    public function getHours(): int
    {
        return $this->hours;
    }

    /**
     * Stores the hours.
     *
     * @param int $hours
     * @return Time
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

    /**
     * Returns the minutes.
     *
     * @return int
     */
    public function getMinutes(): int
    {
        return $this->minutes;
    }

    /**
     * Stores the minutes.
     *
     * @param int $minutes
     * @return Time
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

    /**
     * Returns the seconds.
     *
     * @return int
     */
    public function getSeconds(): int
    {
        return $this->seconds;
    }

    /**
     * Stores the seconds.
     *
     * @param int $seconds
     * @return Time
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

    /**
     * Determines if this time is equal to the provided time.
     *
     * @param Contracts\Time $time
     * @return bool
     */
    public function isEqualTo(Contracts\Time $time): bool
    {
        return $this->toString() === $time->toString();
    }

    /**
     * Determines if this time is before teh provided time.
     *
     * @param Contracts\Time $time
     * @return bool
     */
    public function isBefore(Contracts\Time $time): bool
    {
        return strtotime($this->toString()) < strtotime($time->toString());
    }

    /**
     * Determines if this time is before or equal to the provided time.
     *
     * @param Contracts\Time $time
     * @return bool
     */
    public function isBeforeOrEqualTo(Contracts\Time $time): bool
    {
        return $this->isEqualTo($time) || $this->isBefore($time);
    }

    /**
     * Determines if this time is after the provided time.
     *
     * @param Contracts\Time $time
     * @return bool
     */
    public function isAfter(Contracts\Time $time): bool
    {
        return strtotime($this->toString()) > strtotime($time->toString());
    }

    /**
     * Determines if this time is after or equal to the provided time.
     *
     * @param Contracts\Time $time
     * @return bool
     */
    public function isAfterOrEqualTo(Contracts\Time $time): bool
    {
        return $this->isEqualTo($time) || $this->isAfter($time);
    }

    /**
     * Returns the time part padded with zeros.
     *
     * @param $value
     * @return string
     */
    private function padTime(int $value): string
    {
        return str_pad((string)$value, 2, '0', STR_PAD_LEFT);
    }

    /**
     * Returns the textual presentation of the time.
     *
     * @param bool $hours
     * @param bool $minutes
     * @param bool $seconds
     * @return string
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

    /***
     * Returns the textual presentation of the time.
     *
     * @return string
     */
    public function toString(): string
    {
        return sprintf(
            '%s:%s:%s',
            $this->padTime($this->getHours()),
            $this->padTime($this->getMinutes()),
            $this->padTime($this->getSeconds())
        );
    }

    /**
     * Returns the textual presentation of the time.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->toString();
    }
}
