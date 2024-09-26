<?php

namespace Tests\Operators\Logical;

use BitArray\BitArrays\StringStoredBitArray;
use BitArray\Operators\Logical\ANDable;
use BitArray\Operators\Logical\AndOperators\BitwiseAndOperator;
use PHPUnit\Framework\TestCase;

class ANDTest extends TestCase
{
    /**
     * @dataProvider bitwiseAndProvider
     */
    public function test(ANDable $sut, $bitArray, $expected)
    {
        $result = $sut->and($bitArray);

        foreach ($expected as $index => $expectedValue) {
            $this->assertEquals($expectedValue, $result[$index]);
        }
    }

    public function bitwiseAndProvider()
    {
        $current = new StringStoredBitArray(5);
        $current[0] = 1;
        $current[1] = 1;
        $current[2] = 1;
        $current[3] = 0;
        $current[4] = 0;

        $sut = new BitwiseAndOperator($current);

        $bitArray = new StringStoredBitArray(4);
        $bitArray[0] = 1;
        $bitArray[1] = 0;
        $bitArray[2] = 1;
        $bitArray[3] = 0;

        return [
            'BitwiseAndOperator' => [
                $sut,
                $bitArray,
                [
                    0 => true,
                    1 => false,
                    2 => true,
                    3 => false,
                    4 => false,
                ]
            ],
        ];
    }
}
