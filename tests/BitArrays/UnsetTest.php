<?php

namespace Tests\BitArrays;

use BitArray\BitArrays\OffsetContainableBitArray;
use BitArray\BitArrays\StringStoredBitArray;
use PHPUnit\Framework\TestCase;
use Tests\Support\ImplementationsForTest\TestBitArray;

class UnsetTest extends TestCase
{
    /**
     * @dataProvider stringStoredProvider
     * @dataProvider offsetContainableProvider
     */
    public function test_set_false($sut, $index)
    {
        $sut[$index] = false;

        $this->assertFalse($sut[$index]);
    }

    /**
     * @dataProvider stringStoredProvider
     * @dataProvider offsetContainableProvider
     */
    public function test_unset($sut, $index)
    {
        unset($sut[$index]);

        $this->assertFalse($sut[$index]);
    }

    public function stringStoredProvider()
    {
        $length = 100000;
        $sut = new StringStoredBitArray($length);

        $sut[0] = true;
        $sut[$length - 1] = true;
        $sut[7] = true;
        $sut[8] = true;
        $sut[3] = true;

        return [
            'StringStoredBitArray; set first bit' => [
                $sut,
                0
            ],
            'StringStoredBitArray; set last bit' => [
                $sut,
                $length - 1
            ],
            'StringStoredBitArray; set eighth bit' => [
                $sut,
                7
            ],
            'StringStoredBitArray; set nineth bit' => [
                $sut,
                8,
            ],
            'StringStoredBitArray; set fourth bit' => [
                $sut,
                3,
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

        $firstPosition = $offset;
        $middlePosition = (int) ($offset + ceil($length / 2) - 1);
        $lastPosition = $offset + $length - 1;

        $sut[$firstPosition] = true;
        $sut[$middlePosition] = true;
        $sut[$lastPosition] = true;

        return [
            'OffsetContainableBitArray; unset bit which position before first bit' => [
                $sut,
                $offset - 2,
                false
            ],
            'OffsetContainableBitArray; unset first bit' => [
                $sut,
                $firstPosition
            ],
            'OffsetContainableBitArray; unset middle bit' => [
                $sut,
                $middlePosition
            ],
            'OffsetContainableBitArray; unset last bit' => [
                $sut,
                $lastPosition
            ],
        ];
    }
}
