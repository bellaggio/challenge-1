<?php

declare(strict_types=1);

namespace App\Domain\Electronic\Entity;

use App\Domain\Electronic\TypeInterface;
use App\Domain\Electronic\Types;

class Console extends Types implements TypeInterface
{
    public string $type = 'console';
    protected int $extraNumber = 4;
    protected bool $iterable = false;
}
