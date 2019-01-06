<?php

namespace Vdhicts\Dicms\Time\Contracts;

interface TimeCollection
{
    public function add(Time $time): TimeCollection;
    public function set(array $times): TimeCollection;
    public function contains(Time $time): bool;
}
