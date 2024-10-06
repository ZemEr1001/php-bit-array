<?php

namespace Tests\BitArrays;

use BitArray\BitArrays\OffsetContainableBitArray;
use BitArray\BitArrays\StringStoredBitArray;
use PHPUnit\Framework\TestCase;
use Tests\Support\ImplementationsForTest\TestBitArray;

class CountTest extends TestCase
{
    /**
     * @dataProvider stringStoredProvider
     * @dataProvider offsetContainableProvider
     */
    public function test($sut, $expected)
    {
        $this->assertEquals($expected, count($sut));
    }

    public function stringStoredProvider()
    {
        return [
            'StringStoredBitArray; length equal 1' => [
                new StringStoredBitArray(1),
                1
            ],
            'StringStoredBitArray; length equal 10000' => [
                new StringStoredBitArray(10000),
                10000
            ],
        ];
    }

    public function offsetContainableProvider()
    {
        return [
            'OffsetContainableBitArray; length equal 1' => [
                new OffsetContainableBitArray(0, new TestBitArray(1)),
                1
            ],
            'OffsetContainableBitArray; length equal 10000' => [
                new OffsetContainableBitArray(9999, new TestBitArray(1)),
                10000
            ],
        ];
    }
}
