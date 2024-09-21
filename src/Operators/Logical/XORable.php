<?php

namespace BitArray\Operators\Logical;

use BitArray\BitArray;

interface XORable
{
    public function xor(BitArray $bitArray): BitArray;
}
