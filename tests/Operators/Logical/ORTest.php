<?php

namespace Tests\Operators\Logical;

use BitArray\BitArrays\StringStoredBitArray;
use BitArray\Operators\Logical\ORable;
use BitArray\Operators\Logical\OrOperators\BitwiseOrOperator;
use PHPUnit\Framework\TestCase;

class ORTest extends TestCase
{
    /**
     * @dataProvider bitwiseOrProvider
     */
    public function test(ORable $sut, $bitArray, $expected)
    {
        $result = $sut->or($bitArray);

        foreach ($expected as $index => $expectedValue) {
            $this->assertEquals($expectedValue, $result[$index]);
        }
    }

    public function bitwiseOrProvider()
    {
        $current = new StringStoredBitArray(5);
        $current[0] = 1;
        $current[1] = 1;
        $current[2] = 1;
        $current[3] = 0;
        $current[4] = 0;

        $sut = new BitwiseOrOperator($current);

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
                    0 => true,
                    1 => true,
                    2 => true,
                    3 => false,
                    4 => false,
                ]
            ],
        ];
    }
}
