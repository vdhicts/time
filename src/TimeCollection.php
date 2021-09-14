<?php

namespace Vdhicts\Dicms\Time;

use Vdhicts\Dicms\Time\Contracts;

class TimeCollection implements Contracts\TimeCollection
{
    private array $times = [];

    public function __construct(array $times = [])
    {
        $this->set($times);
    }

    public function add(Contracts\Time $time): Contracts\TimeCollection
    {
        $this->times[] = $time;

        return $this;
    }

    public function set(array $times): Contracts\TimeCollection
    {
        $this->times = [];

        foreach ($times as $time) {
            $this->add($time);
        }

        return $this;
    }

    public function contains(Contracts\Time $time): bool
    {
        $times = array_map(
            function (Contracts\Time $time) {
                return $time->toString();
            },
            $this->times
        );

        return in_array($time->toString(), $times);
    }
}
