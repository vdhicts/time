<?php

namespace Vdhicts\Dicms\Time;

use Vdhicts\Dicms\Time\Contracts;

class TimeCollection implements Contracts\TimeCollection
{
    /**
     * Holds the times for the collection.
     *
     * @var array
     */
    private $times = [];

    /**
     * TimeCollection constructor.
     *
     * @param array $times
     */
    public function __construct(array $times = [])
    {
        $this->set($times);
    }

    /**
     * Add a time to the collection.
     *
     * @param Contracts\Time $time
     * @return TimeCollection
     */
    public function add(Contracts\Time $time): Contracts\TimeCollection
    {
        $this->times[] = $time;

        return $this;
    }

    /**
     * Sets an array of times.
     *
     * @param array $times
     * @return TimeCollection
     */
    public function set(array $times): Contracts\TimeCollection
    {
        $this->times = [];

        foreach ($times as $time) {
            $this->add($time);
        }

        return $this;
    }

    /**
     * Determines if the collection contains a time.
     *
     * @param Contracts\Time $time
     * @return bool
     */
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
