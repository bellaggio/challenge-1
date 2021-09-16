<?php

declare(strict_types=1);

namespace App\Domain\Electronic\UseCase;

use App\Domain\DomainException\TypeException;
use App\Domain\Electronic\TypeInterface;

class GetTotalElectronicPrice
{
    protected float $total;

    public function total(array $listElectronicItems): float
    {
        $this->total = 0.0;
        foreach ($listElectronicItems as $item) {
            if (!$item instanceof TypeInterface) {
                throw new TypeException('Item need to be instance of TypeInterface');
            }
            $this->total += $item->getTotalPrice();
        }
        return $this->total;
    }
}
