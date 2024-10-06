<?php

namespace Tests\BitArrays;

use BitArray\BitArrays\OffsetContainableBitArray;
use BitArray\BitArrays\StringStoredBitArray;
use PHPUnit\Framework\TestCase;
use RangeException;
use Tests\Support\ImplementationsForTest\TestBitArray;

class OutOfRangeTest extends TestCase
{
    /**
     * @dataProvider stringStoredProvider
     * @dataProvider offsetContainableProvider
     */
    public function test($sut, $index)
    {
        $this->expectException(RangeException::class);
        $sut[$index];
    }

    public function stringStoredProvider()
    {
        return [
            'StringStoredBitArray; length equal 1; try to access 2 bit' => [
                new StringStoredBitArray(1),
                1
            ],
            'StringStoredBitArray; length equal 1; try to access -1 bit' => [
                new StringStoredBitArray(1),
                -1
            ],
        ];
    }

    public function offsetContainableProvider()
    {
        return [
            'OffsetContainableBitArray; first bit position is 10, length equal 10; try to access 21 bit' => [
                new OffsetContainableBitArray(10, new TestBitArray(10)),
                20
            ],
            'OffsetContainableBitArray; first bit position is 10, length equal 1; try to access 21 bit' => [
                new OffsetContainableBitArray(10, new TestBitArray(1)),
                -1
            ],
        ];
    }
}
