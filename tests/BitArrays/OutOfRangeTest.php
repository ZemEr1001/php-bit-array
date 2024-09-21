<?php

namespace Tests\BitArrays;

use BitArray\BitArrays\StringStoredBitArray;
use PHPUnit\Framework\TestCase;
use RangeException;

class OutOfRangeTest extends TestCase
{
    /**
     * @dataProvider stringStoredProvider
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
}
