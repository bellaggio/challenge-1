<?php

declare(strict_types=1);

namespace App\Application\Actions\Electronic;

use App\Application\Actions\Action;
use Psr\Log\LoggerInterface;

abstract class ElectronicAction extends Action
{

    public function __construct(LoggerInterface $logger)
    {
        parent::__construct($logger);
    }
}
