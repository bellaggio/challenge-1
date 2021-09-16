<?php

declare(strict_types=1);

namespace App\Domain\Electronic\Entity;

use App\Domain\Electronic\TypeInterface;
use App\Domain\Electronic\Types;

class Controller extends Types implements TypeInterface
{
    public string $type = 'controller';
    protected int $extraNumber = 0;
    protected bool $iterable = true;
}
