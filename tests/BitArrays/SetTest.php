<?php

namespace Tests\BitArrays;

use BitArray\BitArrays\OffsetContainableBitArray;
use BitArray\BitArrays\StringStoredBitArray;
use PHPUnit\Framework\TestCase;
use Tests\Support\ImplementationsForTest\TestBitArray;

class SetTest extends TestCase
{
    /**
     * @dataProvider stringStoredProvider
     * @dataProvider offsetContainableProvider
     */
    public function test($sut, $index, $expexted = null)
    {
        $sut[$index] = true;

        if ($expexted !== null) {
            $this->assertEquals($expexted, $sut[$index]);
        } else {
            $this->assertTrue($sut[$index]);
        }
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

    public function offsetContainableProvider()
    {
        $sut = new OffsetContainableBitArray($offset = 1000, new TestBitArray($length = 1000));
        return [
            'OffsetContainableBitArray; set bit which position before first bit' => [
                $sut,
                $offset - 2,
                false
            ],
            'OffsetContainableBitArray; set first bit' => [
                $sut,
                $offset
            ],
            'OffsetContainableBitArray; set last bit' => [
                $sut,
                $offset + $length - 1
            ],
        ];
    }
}
