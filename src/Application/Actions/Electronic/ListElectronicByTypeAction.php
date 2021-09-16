<?php

declare(strict_types=1);

namespace App\Application\Actions\Electronic;

use App\Domain\Electronic\ElectronicItems;
use App\Domain\Electronic\UseCase\ListElectronicByType;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class ListElectronicByTypeAction extends ElectronicAction
{
    public array $fakeData;

    public function __construct(LoggerInterface $logger)
    {
        parent::__construct($logger);
        $this->fakeData = include __DIR__ . '/../../../../data/data.php';
    }

    protected function action(): Response
    {
        $type = $this->request->getAttribute('type');

        $listElectronicItems = new ElectronicItems($this->fakeData);

        $data = ListElectronicByType::filterBy($listElectronicItems->generate(), $type);

        return $this->respondWithData(['list' => $data], 200);
    }
}
