<?php

declare(strict_types=1);

namespace App\Application\Actions\Electronic;

use App\Application\Actions\Action;
use App\Domain\Electronic\ElectronicItems;
use App\Domain\Electronic\UseCase\SortItemByPrice;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;
use App\Domain\Electronic\UseCase\GetTotalElectronicPrice;

class SortAndReturnTotalPrice extends Action
{
    public array $fakeData;
    protected $totalPrice;
    public function __construct(LoggerInterface $logger, GetTotalElectronicPrice $totalPrice)
    {
        parent::__construct($logger);
        $this->totalPrice = $totalPrice;
        $this->fakeData = include __DIR__ . '/../../../../data/data.php';
    }

    /**
     * @throws \App\Domain\DomainException\TypeException
     */
    protected function action(): Response
    {
        $condition = $this->request->getQueryParams()['condition'] ?? '';

        $listElectronicItems = new ElectronicItems($this->fakeData);

        $data = SortItemByPrice::sort($listElectronicItems->generate(), $condition);

        return $this->respondWithData(['total'=> $this->totalPrice->total($data) ,'list' => $data], 200);
    }
}
