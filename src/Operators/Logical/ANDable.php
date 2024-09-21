<?php

namespace BitArray\Operators\Logical;

use BitArray\BitArray;

interface ANDable
{
    public function and(BitArray $bitArray): BitArray;
}
