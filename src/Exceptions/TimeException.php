<?php

namespace Vdhicts\Dicms\Time\Exceptions;

use Exception;

class TimeException extends Exception
{
    public static function unableToCreateFromString(string $value): self
    {
        return new self(
            sprintf('Unable to create a Time value object from `%s`', $value)
        );
    }

    public static function invalidHours(int $hours): self
    {
        return new self(
            sprintf('Invalid hours provided: `%d`, must be between 0 and 23', $hours)
        );
    }

    public static function invalidMinutes(int $minutes): self
    {
        return new self(
            sprintf('Invalid minutes provided: `%d`, must be between 0 and 59', $minutes)
        );
    }

    public static function invalidSeconds(int $seconds): self
    {
        return new self(
            sprintf('Invalid seconds provided: `%d`, must be between 0 and 59', $seconds)
        );
    }

}
