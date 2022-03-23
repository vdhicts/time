<?php

namespace Vdhicts\Time\Contracts;

interface TimeCollectionInterface
{
    public function add(TimeInterface $time): TimeCollectionInterface;

    /**
     * @param TimeInterface[] $times
     */
    public function set(array $times): TimeCollectionInterface;
    public function contains(TimeInterface $time): bool;
}
