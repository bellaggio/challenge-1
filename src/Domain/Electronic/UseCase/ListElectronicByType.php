<?php

namespace App\Domain\Electronic\UseCase;

use App\Domain\DomainException\TypeException;
use App\Domain\Electronic\TypeInterface;

class ListElectronicByType
{

    public static function filterBy(array $array, string $type): array
    {
        return array_filter(array_map(static function ($item) use ($type) {

            if (!$item instanceof TypeInterface) {
                throw new TypeException('Item need to be instance of TypeInterface');
            }

            if ($item->getType() == $type) {
                return $item;
            }
        }, $array));
    }
}
