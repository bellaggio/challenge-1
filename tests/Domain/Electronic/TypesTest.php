<?php


use App\Domain\Electronic\Types as AbstractTypes;

class wrapperTypesIterableFalse extends AbstractTypes
{
    public int $extraNumber = 2;
    public bool $iterable = false;
    public string $type = 'wrapper-false';
}

class wrapperTypesIterableTrue extends AbstractTypes
{
    public int $extraNumber = 2;
    public bool $iterable = true;
    public string $type = 'wrapper-true';
}

class wrapperTypesIterableTrueWithoutExtraItem extends AbstractTypes
{
    public int $extraNumber = 0;
    public bool $iterable = true;
    public string $type = 'wrapper-true-no-extra-item';
}

class TypesTest extends \Tests\TestCase
{
    private mixed $extraMock;

    public function setUp(): void
    {
        $this->extraMock = $this->getMockBuilder(\App\Domain\Electronic\Extra::class)
            ->onlyMethods(['items', 'count'])
            ->getMock();

        parent::setUp();
    }

    public function testMaxExtraNeedReturnDefaultValue(): void
    {
        $wrapperDefaultMaxValue = 2;
        $wrapper = new wrapperTypesIterableFalse();
        $this->assertEquals($wrapperDefaultMaxValue, $wrapper->maxExtras());
    }

    public function testIsExtraNeedToReturnFalse(): void
    {
        $wrapper = new wrapperTypesIterableFalse();
        $this->assertEquals(false, $wrapper->isIterable());
    }

    public function testExtraListNeedToBeArray(): void
    {
        $this->extraMock->method('items')->willReturn([]);
        $wrapper = new wrapperTypesIterableFalse();
        $extra = $wrapper
            ->addExtra($this->extraMock)
            ->list();
        $this->assertIsArray($extra);
    }

    public function testExtraListContainTypeInterfaceItem(): void
    {
        $this->extraMock->method('items')->willReturn([new wrapperTypesIterableTrue()]);
        $wrapper = new wrapperTypesIterableFalse();
        $extra = $wrapper
            ->addExtra($this->extraMock)
            ->list();
        $this->assertInstanceOf(wrapperTypesIterableTrue::class, $extra[0]);
    }

    public function testShouldReturnExceptionWhenItemsNumberIsMoreThanMaxExtraLimits(): void
    {
        $this->expectException(\App\Domain\DomainException\TypeException::class);
        $this->extraMock->method('count')->willReturn(5);
        $wrapper = new wrapperTypesIterableTrueWithoutExtraItem();
        $wrapper
            ->addExtra($this->extraMock)
            ->list();
    }

    public function testShouldReturnAmountOfItemTimesPrices(): void
    {
        $wrapper = new wrapperTypesIterableTrueWithoutExtraItem();
        $wrapper->setAmount(3);
        $wrapper->setPrice(100.00);
        $this->assertEquals(300.00,$wrapper->getPrice());
    }
}
