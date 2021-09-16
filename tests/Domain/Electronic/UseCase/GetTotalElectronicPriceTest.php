<?php

declare(strict_types=1);

use App\Domain\Electronic\UseCase\GetTotalElectronicPrice;

class GetTotalElectronicPriceTest extends \Tests\TestCase
{
    private GetTotalElectronicPrice $getTotalElectronicPrice;

    public function setUp(): void
    {
        parent::setUp();
        $this->getTotalElectronicPrice = new GetTotalElectronicPrice();
    }

    /**
     * @throws \App\Domain\DomainException\TypeException
     */
    public function testShouldReturnTotalPriceByListOfItem():void{
        $console = new \App\Domain\Electronic\Entity\Console();
        $console->setPrice(100.00);
        $console->setAmount(1);

        $television = new \App\Domain\Electronic\Entity\Television();
        $television->setPrice(200.00);
        $television->setAmount(1);

        $list = [
            $console, $television
        ];
        $expected = 300.00;

        $result =  $this->getTotalElectronicPrice->total($list);

        $this->assertEquals($expected,$result);
    }


    public function testShouldGivenExceptionWhenItemIsNotInstanceOfTypeInterface():void{
        $this->expectException(\App\Domain\DomainException\TypeException::class);
        $console = new \App\Domain\Electronic\Entity\Console();
        $console->setPrice(100.00);
        $console->setAmount(1);

        $list = [
            $console, []
        ];

       $this->getTotalElectronicPrice->total($list);
    }
}
