<?php

declare(strict_types=1);

namespace App\Domain\Electronic;

class Extra implements \Countable, \Iterator
{
    public array $items = [];
    private int $position = 0;

    public function current()
    {
        return $this->items[$this->position];
    }

    public function key(): int
    {
        return $this->position;
    }

    public function valid(): bool
    {
        return isset($this->items[$this->position]);
    }

    public function rewind(): int
    {
        return $this->position = 0;
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function add(TypeInterface $electronicItem): Extra
    {
        if (!$electronicItem->isIterable()) {
            throw new \Exception('This electronic type is not available to be extra');
        }

        $this->items[$this->position] = $electronicItem;
        $this->next();
        return $this;
    }

    public function next(): void
    {
        ++$this->position;
    }

    public function items(): array
    {
        return $this->items;
    }

    public function totalPrice(): float
    {
        $total = 0;
        foreach ($this->items as $item) {
            if (!$item instanceof TypeInterface) {
                continue;
            }
            $total += $item->getPrice();
        }
        return $total;
    }
}
