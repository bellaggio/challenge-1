<?php

declare(strict_types=1);

namespace App\Domain\Electronic;

use App\Domain\DomainException\TypeException;

abstract class Types
{
    public Extra $extra;
    public float $price;
    public bool $wired;
    public string $title;
    public string $type;
    public int $amount;

    /**
     * @param Extra $extra
     * @return $this
     * @throws \Exception
     */
    public function addExtra(Extra $extra): Types
    {

        if ($this->extraNumber === 0) {
            throw new TypeException('The type ' . $this->type . ' has no possibility to add extra item');
        }

        if ($extra->count() > $this->extraNumber && $this->extraNumber !== -1) {
            $message = 'The type ' . $this->type . ' has possibility to add just ' . $this->maxExtras() . ' extra';
            throw new TypeException($message);
        }

        $this->extra = $extra;
        return $this;
    }

    /**
     * @return int
     */
    public function maxExtras(): int
    {
        return $this->extraNumber;
    }

    /**
     * @return bool
     */
    public function isIterable(): bool
    {
        return $this->iterable;
    }

    /**
     * @return array
     */
    public function list(): array
    {
        return $this->extra->items();
    }

    /**
     * @return float
     */
    public function getTotalPrice(): float
    {
        if (isset($this->extra)) {
            return $this->extra->totalPrice() + $this->getPrice();
        }
        return $this->getPrice();
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return ($this->price * $this->getAmount());
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): void
    {
        $this->amount = $amount;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return bool
     */
    public function isWired(): bool
    {
        return $this->wired;
    }

    /**
     * @param bool $wired
     */
    public function setWired(bool $wired): void
    {
        $this->wired = $wired;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }
}
