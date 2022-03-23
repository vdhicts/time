<?php

namespace Vdhicts\Time\Traits;

use Vdhicts\Time\Contracts\TimeInterface;
use Vdhicts\Time\Exceptions\TimeException;
use Vdhicts\Time\Time;

trait Cloneable
{
    /**
     * @throws TimeException
     */
    public function clone(): TimeInterface
    {
        return new Time($this->getHours(), $this->getMinutes(), $this->getSeconds());
    }
}
