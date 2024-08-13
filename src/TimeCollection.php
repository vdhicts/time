<?php

namespace Vdhicts\Time;

use Vdhicts\Time\Contracts\TimeCollectionInterface;
use Vdhicts\Time\Contracts\TimeInterface;

class TimeCollection implements TimeCollectionInterface
{
    /**
     * @var TimeInterface[]
     */
    private array $times = [];

    /**
     * @param TimeInterface[] $times
     */
    public function __construct(array $times = [])
    {
        $this->set($times);
    }

    public function add(TimeInterface $time): TimeCollectionInterface
    {
        $this->times[] = $time;

        return $this;
    }

    /*
     * @inheritDoc
     */
    public function set(array $times): TimeCollectionInterface
    {
        $this->times = [];

        foreach ($times as $time) {
            $this->add($time);
        }

        return $this;
    }

    public function contains(TimeInterface $time): bool
    {
        $times = array_map(
            fn(TimeInterface $time): string => $time->toString(),
            $this->times,
        );

        return in_array($time->toString(), $times, true);
    }
}
