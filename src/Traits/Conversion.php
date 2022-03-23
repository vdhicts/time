<?php

namespace Vdhicts\Time\Traits;

trait Conversion
{
    /**
     * Returns the textual presentation of the time.
     */
    public function format(bool $showSeconds = false): string
    {
        if ($showSeconds) {
            return sprintf(
                '%02d:%02d:%02d',
                $this->getHours(),
                $this->getMinutes(),
                $this->getSeconds()
            );
        }

        return sprintf(
            '%02d:%02d',
            $this->getHours(),
            $this->getMinutes()
        );
    }

    public function toString(): string
    {
        return $this->format(true);
    }

    public function __toString(): string
    {
        return $this->toString();
    }
}
