<?php

namespace Vdhicts\Dicms\Time\Contracts;

interface Time
{
    public function getHours(): int;
    public function getMinutes(): int;
    public function getSeconds(): int;

    public function isEqualTo(Time $time): bool;
    public function isBefore(Time $time): bool;
    public function isBeforeOrEqualTo(Time $time): bool;
    public function isAfter(Time $time): bool;
    public function isAfterOrEqualTo(Time $time): bool;

    public function toString(): string;
}
