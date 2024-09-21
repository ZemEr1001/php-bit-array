<?php

namespace BitArray\Operators\Logical;

use BitArray\BitArray;

interface ORable
{
    public function or(BitArray $bitArray): BitArray;
}
