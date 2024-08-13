<?php

namespace Vdhicts\Time;

use Vdhicts\Time\Exceptions\TimeException;

class TimeFactory
{
    /**
     * @throws TimeException
     */
    public static function createFromString(string $value): Time
    {
        $timestamp = strtotime($value);
        if ($timestamp === 0 || $timestamp === false) {
            throw TimeException::unableToCreateFromString($value);
        }

        return self::createFromTimestamp($timestamp);
    }

    /**
     * @throws TimeException
     */
    public static function createFromTimestamp(int $timestamp): Time
    {
        $hours = date('H', $timestamp);
        $minutes = date('i', $timestamp);
        $seconds = date('s', $timestamp);

        return (new Time())
            ->setHours((int) $hours)
            ->setMinutes((int) $minutes)
            ->setSeconds((int) $seconds);
    }

    /**
     * @throws TimeException
     */
    public static function createFromDurationInSeconds(int $seconds): Time
    {
        $hours = floor($seconds / 3600);
        $minutes = floor($seconds / 60) % 60;
        $seconds %= 60;

        return new Time((int) $hours, $minutes, $seconds);
    }

    /**
     * @throws TimeException
     */
    public static function createFromDurationInMinutes(int $minutes): Time
    {
        $hours = floor($minutes / 60);
        $minutes %= 60;

        return new Time((int) $hours, $minutes, 0);
    }
}
