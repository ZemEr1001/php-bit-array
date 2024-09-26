<?php

namespace BitArray\Operators\Logical\AndOperators;

use BitArray\BitArray;
use BitArray\Operators\Logical\ANDable;

class BitwiseAndOperator implements ANDable
{
    private $current;

    public function __construct(BitArray &$bitArray)
    {
        $this->current = $bitArray;
    }

    public function and(BitArray $bitArray): BitArray
    {
        $lengthLeft = count($this->current);
        $lengthRight = count($bitArray);
        $result = $lengthLeft > $lengthRight
        ? clone $this->current
        : clone $bitArray;

        $minLength = min($lengthLeft, $lengthRight);
        for ($i = 0; $i < $minLength; $i++) {
            $result[$i] = $this->current[$i] & $bitArray[$i];
        }

        return $result;
    }
}
