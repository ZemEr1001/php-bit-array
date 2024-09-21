<?php

namespace Tests\BitArrays;

use BitArray\BitArrays\StringStoredBitArray;
use PHPUnit\Framework\TestCase;

class CountTest extends TestCase
{
    /**
     * @dataProvider stringStoredProvider
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
}
