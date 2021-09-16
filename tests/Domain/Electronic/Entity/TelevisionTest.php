<?php

use App\Domain\Electronic\Entity\Television;

class TelevisionTest extends \Tests\TestCase
{
    /**
     * @var $extraMock \App\Domain\Electronic\Extra;

     */
    public $extraMock;

    public function setUp(): void
    {
        $this->extraMock = $this->getMockBuilder(\App\Domain\Electronic\Extra::class)
            ->onlyMethods(['items'])
            ->getMock();

        parent::setUp();
    }

    public function testMaxExtraNeedReturnDefaultValue():void{
        $televisionDefaultMaxValue = -1;
        $television = new Television();
        $this->assertEquals($televisionDefaultMaxValue , $television->maxExtras());
    }

    public function testIsExtraNeedToReturnFalse():void{
        $television = new Television();
        $this->assertEquals(false,$television->isIterable());
    }

    public function testExtraListNeedToBeArray():void{
        $this->extraMock->method('items')->willReturn([]);
        $television = new Television();
        $extra = $television
            ->addExtra($this->extraMock)
            ->list();
        $this->assertIsArray($extra);
    }

    public function testExtraListContainTypeInterfaceItem(){
        $this->extraMock->method('items')->willReturn([new \App\Domain\Electronic\Entity\Controller()]);
        $television = new Television();
        $extra = $television
            ->addExtra($this->extraMock)
            ->list();
        $this->assertInstanceOf(  \App\Domain\Electronic\TypeInterface::class,$extra[0]);
    }
}
