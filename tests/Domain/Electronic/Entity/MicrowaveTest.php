<?php

use App\Domain\Electronic\Entity\Microwave;

class MicrowaveTest extends \Tests\TestCase
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
        $microwaveDefaultMaxValue = 0;
        $microwave = new Microwave();
        $this->assertEquals($microwaveDefaultMaxValue , $microwave->maxExtras());
    }

    public function testIsExtraNeedToReturnFalse():void{
        $microwave = new Microwave();
        $this->assertEquals(false,$microwave->isIterable());
    }

    public function testShouldShowExceptionWhenAddExtraItem():void{
        $this->expectExceptionMessage('The type microwave has no possibility to add extra item');
        $this->extraMock->method('items')->willReturn([]);
        $microwave = new Microwave();
        $extra = $microwave
            ->addExtra($this->extraMock)
            ->list();
        $this->assertIsArray($extra);
    }
}
