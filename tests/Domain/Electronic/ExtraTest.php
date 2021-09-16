<?php


class ExtraTest extends \Tests\TestCase
{
    /**
     * @throws Exception
     */
    public function testGivenExceptionWhenAddedItemIsNotIterable():void{
        $this->expectExceptionMessage('This electronic type is not available to be extra');
        $extra = new \App\Domain\Electronic\Extra();
        $television = $this->createMock(\App\Domain\Electronic\Entity\Television::class);
        $television->method('isIterable')
            ->willReturn(false);
        $extra->add($television);
    }

    public function testGivenCountOfItems():void{
        $extra = new \App\Domain\Electronic\Extra();
        $television = $this->createMock(\App\Domain\Electronic\Entity\Television::class);
        $television->method('isIterable')
            ->willReturn(true);

        $extra->add($television);
        $extra->add($television);
        $this->assertEquals(2,$extra->count());
    }

    public function testShouldReturnAllExtraItemsPrice():void{
        $extra = new \App\Domain\Electronic\Extra();
        $television1 = $this->createMock(\App\Domain\Electronic\Entity\Television::class);
        $television1->method('isIterable')
            ->willReturn(true);
        $television1->method('getPrice')
            ->willReturn(300.00);

        $television2 = $this->createMock(\App\Domain\Electronic\Entity\Television::class);
        $television2->method('isIterable')
            ->willReturn(true);
        $television2->method('getPrice')
            ->willReturn(150.00);

        $extra->add($television1);
        $extra->add($television2);
        $this->assertEquals(450.00,$extra->totalPrice());
    }
}
