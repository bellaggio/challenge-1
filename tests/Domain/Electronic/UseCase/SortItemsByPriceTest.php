<?php

declare(strict_types=1);

use App\Domain\Electronic\UseCase\SortItemByPrice;

class SortItemsByPriceTest extends \Tests\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function testShouldSortItemsByPrice():void{
        $console = new \App\Domain\Electronic\Entity\Console();
        $console->setPrice(100.00);
        $console->setAmount(1);

        $television = new \App\Domain\Electronic\Entity\Television();
        $television->setPrice(200.00);
        $television->setAmount(1);

        $list = [
            $console, $television
        ];
        $expected = [
            $television, $console
        ];

        $result =  SortItemByPrice::sort($list,'desc');

        $this->assertEquals($expected,$result);
    }

}
