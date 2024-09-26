<?php

namespace Tests\Operators\Logical;

use BitArray\BitArrays\StringStoredBitArray;
use BitArray\Operators\Logical\NOTable;
use BitArray\Operators\Logical\NotOperators\BitwiseNotOperator;
use PHPUnit\Framework\TestCase;

class NOTTest extends TestCase
{
    /**
     * @dataProvider bitwiseNotProvider
     */
    public function test(NOTable $sut, $expected)
    {
        $result = $sut->not();

        foreach ($expected as $index => $expectedValue) {
            $this->assertEquals($expectedValue, $result[$index]);
        }
    }

    public function bitwiseNotProvider()
    {
        $current = new StringStoredBitArray(5);
        $current[0] = 1;
        $current[1] = 1;
        $current[2] = 1;
        $current[3] = 0;
        $current[4] = 0;

        $sut = new BitwiseNotOperator($current);


        return [
            'BitwiseOrOperator' => [
                $sut,
                [
                    0 => false,
                    1 => false,
                    2 => false,
                    3 => true,
                    4 => true,
                ]
            ],
        ];
    }
}
