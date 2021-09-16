<?php

use App\Domain\Electronic\Entity\Controller;

class ControllerTest extends \Tests\TestCase
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
        $controllerDefaultMaxValue = 0;
        $controller = new Controller();
        $this->assertEquals($controllerDefaultMaxValue , $controller->maxExtras());
    }

    public function testIsExtraNeedToReturnFalse():void{
        $controller = new Controller();
        $this->assertEquals(true, $controller->isIterable());
    }

    public function testShouldShowExceptionWhenAddExtraItem():void{
        $this->expectException(\App\Domain\DomainException\TypeException::class);
        $this->extraMock->method('items')->willReturn(['index']);
        $controller = new Controller();
        $controller->addExtra($this->extraMock);
    }
}
