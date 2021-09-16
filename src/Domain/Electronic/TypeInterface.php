<?php

declare(strict_types=1);

namespace App\Domain\Electronic;

interface TypeInterface
{
    public function maxExtras(): int;

    public function isIterable(): bool;

    public function getTotalPrice(): float;

    public function getPrice(): float;

    public function getTitle(): string;

    public function getAmount(): int;

    public function getType(): string;

    public function isWired(): bool;

    public function setWired(bool $wired): void;

    public function setTitle(string $title): void;

    public function setPrice(float $price): void;

    public function setAmount(int $amount): void;

    public function setType(string $type): void;
}
