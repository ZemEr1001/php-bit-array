<?php

namespace BitArray\Operators\Logical\NotOperators;

use BitArray\BitArray;
use BitArray\Operators\Logical\NOTable;

class BitwiseNotOperator implements NOTable
{
    private $current;

    public function __construct(BitArray &$bitArray)
    {
        $this->current = $bitArray;
    }

    public function not(): BitArray
    {
        $result = clone $this->current;

        $length = count($result);
        for ($i = 0; $i < $length; $i++) {
            $result[$i] = !$result[$i];
        }

        return $result;
    }
}
