<?php

declare(strict_types=1);

namespace App\Domain\Electronic\Entity;

use App\Domain\Electronic\TypeInterface;
use App\Domain\Electronic\Types;

class Television extends Types implements TypeInterface
{
    public string $type = 'television';
    protected int $extraNumber = -1;
    protected bool $iterable = false;
}
