<?php
declare(strict_types=1);

use App\Domain\Electronic\UseCase\ListElectronicByType;

class ListElectronicByTypeTest extends \Tests\TestCase
{

    public function testShouldReturnItemsByType():void{
        $console = new \App\Domain\Electronic\Entity\Console();
        $console->setPrice(100.00);
        $console->setAmount(1);
        $console->setType('console');

        $television = new \App\Domain\Electronic\Entity\Television();
        $television->setPrice(200.00);
        $television->setAmount(1);
        $television->setType('television');

        $list = [
            $console, $television
        ];
        $expected = [
            $console
        ];

        $result =  ListElectronicByType::filterBy($list,'console');
        $this->assertEquals($expected,$result);
    }

    public function testShouldGivenExceptionWhenItemIsNotInstanceOfTypeInterface():void{
        $this->expectException(\App\Domain\DomainException\TypeException::class);
        $console = new \App\Domain\Electronic\Entity\Console();
        $console->setPrice(100.00);
        $console->setAmount(1);
        $console->setType('console');

        $list = [
            $console,[]
        ];

        ListElectronicByType::filterBy($list,'console');
    }
}
