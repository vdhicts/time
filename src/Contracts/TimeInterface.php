<?php

namespace Vdhicts\Time\Contracts;

interface TimeInterface
{
    public function getHours(): int;
    public function setHours(int $hours): self;
    public function getMinutes(): int;
    public function setMinutes(int $minutes): self;
    public function getSeconds(): int;
    public function setSeconds(int $seconds): self;

    // Clone
    public function clone(): TimeInterface;

    // Comparison
    public function isEqualTo(TimeInterface $time): bool;
    public function isBefore(TimeInterface $time): bool;
    public function isBeforeOrEqualTo(TimeInterface $time): bool;
    public function isAfter(TimeInterface $time): bool;
    public function isAfterOrEqualTo(TimeInterface $time): bool;

    // Difference
    public function diff(TimeInterface $time): TimeInterface;
    public function diffInSeconds(TimeInterface $time): int;
    public function diffInMinutes(TimeInterface $time): float;
    public function diffInHours(TimeInterface $time): float;

    // Duration
    public function durationInHours(): float;
    public function durationInMinutes(): float;
    public function durationInSeconds(): int;

    // Rounding
    public function roundUp(int $precision = 5, bool $roundSeconds = false): TimeInterface;
    public function roundNatural(int $precision = 5, bool $roundSeconds = false): TimeInterface;
    public function roundDown(int $precision = 5, bool $roundSeconds = false): TimeInterface;

    // Presentation
    public function present(): TimePresenterInterface;
    public function toString(): string;
}
