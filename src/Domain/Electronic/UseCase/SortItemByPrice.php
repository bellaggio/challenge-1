<?php

namespace App\Domain\Electronic\UseCase;

use App\Domain\Electronic\TypeInterface;

class SortItemByPrice
{
    public static function sort(array $array, string $condition = 'asc'): array
    {
        usort($array, static function (TypeInterface $a, TypeInterface $b) use ($condition) {
            if ($condition === 'asc') {
                return ($a->getTotalPrice() > $b->getTotalPrice() ? 1 : -1);
            }
            return ($a->getTotalPrice() < $b->getTotalPrice() ? 1 : -1);
        });
        return $array;
    }
}
