<?php

use App\Domain\Electronic\Entity\Console;

class ConsoleTest extends \Tests\TestCase
{
    /**
     * @var $extraMock \App\Domain\Electronic\Extra;

     */
    public $extraMock;

    public function setUp(): void
    {
        $this->extraMock = $this->getMockBuilder(\App\Domain\Electronic\Extra::class)
            ->onlyMethods(['items','count'])
            ->getMock();

        parent::setUp();
    }

    public function testMaxExtraNeedReturnDefaultValue():void{
        $consoleDefaultMaxValue = 4;
        $console = new Console();
        $this->assertEquals($consoleDefaultMaxValue , $console->maxExtras());
    }

    public function testIsExtraNeedToReturnFalse():void{
        $console = new Console();
        $this->assertEquals(false,$console->isIterable());
    }

    public function testExtraListNeedToBeArray():void{
        $this->extraMock->method('items')->willReturn([]);
        $console = new Console();
        $extra = $console
            ->addExtra($this->extraMock)
            ->list();
        $this->assertIsArray($extra);
    }

    public function testExtraListContainTypeInterfaceItem(){
        $this->extraMock->method('items')->willReturn([new \App\Domain\Electronic\Entity\Controller()]);
        $console = new Console();
        $extra = $console
            ->addExtra($this->extraMock)
            ->list();
        $this->assertInstanceOf(  \App\Domain\Electronic\TypeInterface::class,$extra[0]);
    }

    public function testShouldReturnExceptionWhenItemsNumberIsMoreThanMaxExtraLimits(){
        $this->expectExceptionMessage('The type console has possibility to add just 4 extra');
        $this->extraMock->method('count')->willReturn(5);
        $console = new Console();
        $extra = $console
            ->addExtra($this->extraMock)
            ->list();
        $this->assertInstanceOf(  \App\Domain\Electronic\Controller::class,$extra[0]);
    }
}
