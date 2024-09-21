<?php

namespace Tests\BitArrays;

use BitArray\BitArrays\StringStoredBitArray;
use PHPUnit\Framework\TestCase;

class SetTest extends TestCase
{
    /**
     * @dataProvider stringStoredProvider
     */
    public function test($sut, $index)
    {
        $sut[$index] = true;

        $this->assertTrue($sut[$index]);
    }

    public function stringStoredProvider()
    {
        $sut = new StringStoredBitArray(100000);

        return [
            'StringStoredBitArray; set first bit' => [
                $sut,
                0
            ],
            'StringStoredBitArray; set last bit' => [
                $sut,
                100000 - 1
            ],
            'StringStoredBitArray; set eighth bit' => [
                $sut,
                8
            ],
            'StringStoredBitArray; set nineth bit' => [
                $sut,
                9,
            ],
            'StringStoredBitArray; set fourth bit' => [
                $sut,
                4,
            ],
            'StringStoredBitArray; set first bit when length equal 1' => [
                new StringStoredBitArray(1),
                0
            ],
        ];
    }
}
