<?php

namespace Vdhicts\Time;

use Vdhicts\Time\Contracts;

class TimeCollection implements Contracts\TimeCollectionInterface
{
    /**
     * @var Contracts\TimeInterface[]
     */
    private array $times = [];

    /**
     * @param Contracts\TimeInterface[] $times
     */
    public function __construct(array $times = [])
    {
        $this->set($times);
    }

    public function add(Contracts\TimeInterface $time): Contracts\TimeCollectionInterface
    {
        $this->times[] = $time;

        return $this;
    }

    /*
     * @inheritDoc
     */
    public function set(array $times): Contracts\TimeCollectionInterface
    {
        $this->times = [];

        foreach ($times as $time) {
            $this->add($time);
        }

        return $this;
    }

    public function contains(Contracts\TimeInterface $time): bool
    {
        $times = array_map(
            function (Contracts\TimeInterface $time) {
                return $time->toString();
            },
            $this->times
        );

        return in_array($time->toString(), $times);
    }
}
