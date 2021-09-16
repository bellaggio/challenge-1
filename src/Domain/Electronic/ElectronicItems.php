<?php

declare(strict_types=1);

namespace App\Domain\Electronic;

use App\Infrastructure\Factory\ElectronicItemFactory;

class ElectronicItems
{
    protected array $list = [];

    public function __construct(public array $items)
    {}

    public function generate(): array
    {
        foreach ($this->items as $item) {
            if (!is_array($item)) {
                continue;
            }
            $this->list[] = ElectronicItemFactory::getItem($item);
        }
        return $this->list;
    }
}
