<?php

declare(strict_types=1);

use App\Domain\Electronic\ElectronicItems;
use App\Domain\Electronic\Entity\Console;


class ElectronicItemsTest extends \Tests\TestCase
{
        protected mixed $mockFactory;

        protected ElectronicItems $electronicItems;

        protected Console $mockConsole;

        public function testShouldReturnListOfItems():void{

            $purchase = [
                [
                    'title'=>'ps4',
                    'type'=>'console',
                    'price'=>250.00,
                    'amount'=>1,
                    'wired'=> true,
                    'extra'=>[
                        ['title'=>'controller ps4','amount'=>2,'type'=>'controller','wired'=>true,'price'=>34.00]
                    ]
                ]
            ];

            $list = new ElectronicItems($purchase);

            $result = $list->generate();
            $this->assertIsArray($result);
            $this->assertEquals('ps4',$result[0]->getTitle());
            $this->assertEquals('controller ps4',$result[0]->list()[0]->getTitle());
        }

}
