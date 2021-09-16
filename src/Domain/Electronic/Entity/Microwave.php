<?php

declare(strict_types=1);

namespace App\Domain\Electronic\Entity;

use App\Domain\Electronic\TypeInterface;
use App\Domain\Electronic\Types;

class Microwave extends Types implements TypeInterface
{
    public string $type = 'microwave';
    protected int $extraNumber = 0;
    protected bool $iterable = false;
}
