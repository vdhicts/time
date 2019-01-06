<?php

namespace Vdhicts\Dicms\Time\Exceptions;

class TimeException extends TimePackageException
{
    /**
     * @param string $value
     * @return TimeException
     */
    public static function unableToCreateFromString(string $value): self
    {
        return new self(
            sprintf('Unable to create a Time value object from `%s`', $value)
        );
    }

    /**
     * @param int $hours
     * @return TimeException
     */
    public static function invalidHours(int $hours): self
    {
        return new self(
            sprintf('Invalid hours provided: `%d`, must be between 0 and 23', $hours)
        );
    }

    /**
     * @param int $minutes
     * @return TimeException
     */
    public static function invalidMinutes(int $minutes): self
    {
        return new self(
            sprintf('Invalid minutes provided: `%d`, must be between 0 and 59', $minutes)
        );
    }

    /**
     * @param int $seconds
     * @return TimeException
     */
    public static function invalidSeconds(int $seconds): self
    {
        return new self(
            sprintf('Invalid seconds provided: `%d`, must be between 0 and 59', $seconds)
        );
    }

}
