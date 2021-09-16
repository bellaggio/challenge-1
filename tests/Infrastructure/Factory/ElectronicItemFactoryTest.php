<?php
use App\Infrastructure\Factory\ElectronicItemFactory;

class ElectronicItemFactoryTest extends \Tests\TestCase
{

    public function testShouldReturnTrueWhenArrayIsValid():void{

        $factory =  ElectronicItemFactory::isValid([
            'title'=>'ps4 aaa',
            'type'=>'console',
            'price'=>250.00,
            'amount'=>1,
            'wired'=> true,
            'extra'=>[
                ['title'=>'controller ps4','amount'=>2,'type'=>'controller', 'wired'=> true, 'price'=>34.00]
            ]
        ]);

        $this->assertTrue($factory);
    }

    /**
     * @throws Exception
     */
    public function testIfReturnInstanceOfType():void{

        $factory = ElectronicItemFactory::getItem([
            'title'=>'ps4 aaa',
            'type'=>'console',
            'amount'=> 1,
            'wired'=> true,
            'price'=>250.00,
            'extra'=>[
                ['title'=>'controller ps4','amount'=>2,'type'=>'controller','wired'=>true,'price'=>34.00]
            ]
        ]);

        $this->assertInstanceOf(\App\Domain\Electronic\TypeInterface::class, $factory);
    }

    /**
     * @throws Exception
     */
    public function testShouldReturnElectronicTypeWithExtra():void{

        $factory = ElectronicItemFactory::getItem([
            'title'=>'ps4 bbb',
            'type'=>'console',
            'amount'=> 1,
            'wired'=> true,
            'price'=>250.00,
            'extra'=>[
                ['title'=>'controller ps4','amount'=>2,'type'=>'controller','wired'=>true,'price'=>34.00]
            ]
        ]);
        $this->assertEquals('controller', $factory->list()[0]->getType());
        $this->assertEquals(68.00, $factory->list()[0]->getPrice());
        $this->assertEquals(318.00, $factory->getTotalPrice());
        $this->assertEquals(250.00, $factory->getPrice());
        $this->assertTrue($factory->isWired());
        $this->assertTrue($factory->list()[0]->isWired());
    }
}
