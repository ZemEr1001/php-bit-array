<?php

namespace Tests\Operators\Logical;

use BitArray\BitArrays\StringStoredBitArray;
use BitArray\Operators\Logical\XORable;
use BitArray\Operators\Logical\XorOperators\BitwiseXorOperator;
use PHPUnit\Framework\TestCase;

class XORTest extends TestCase
{
    /**
     * @dataProvider bitwiseXorProvider
     */
    public function test(XORable $sut, $bitArray, $expected)
    {
        $result = $sut->xor($bitArray);

        foreach ($expected as $index => $expectedValue) {
            $this->assertEquals($expectedValue, $result[$index]);
        }
    }

    public function bitwiseXorProvider()
    {
        $current = new StringStoredBitArray(5);
        $current[0] = 1;
        $current[1] = 1;
        $current[2] = 1;
        $current[3] = 0;
        $current[4] = 0;

        $sut = new BitwiseXorOperator($current);

        $bitArray = new StringStoredBitArray(4);
        $bitArray[0] = 1;
        $bitArray[1] = 0;
        $bitArray[2] = 1;
        $bitArray[3] = 0;

        return [
            'BitwiseOrOperator' => [
                $sut,
                $bitArray,
                [
                    0 => false,
                    1 => true,
                    2 => false,
                    3 => false,
                    4 => false,
                ]
            ],
        ];
    }
}
