<?php

namespace BitArray\Operators\Logical\OrOperators;

use BitArray\BitArray;
use BitArray\Operators\Logical\ORable;

class BitwiseOrOperator implements ORable
{
    private $current;

    public function __construct(BitArray &$bitArray)
    {
        $this->current = $bitArray;
    }

    public function or(BitArray $bitArray): BitArray
    {
        $lengthLeft = count($this->current);
        $lengthRight = count($bitArray);
        $result = $lengthLeft > $lengthRight
        ? clone $this->current
        : clone $bitArray;

        $minLength = min($lengthLeft, $lengthRight);
        for ($i = 0; $i < $minLength; $i++) {
            $result[$i] = $this->current[$i] | $bitArray[$i];
        }

        return $result;
    }
}
