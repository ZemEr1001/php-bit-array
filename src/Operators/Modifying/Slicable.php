<?php

namespace BitArray\Operators\Modifying;

use BitArray\BitArray;

interface Slicable
{
    public function slice(int $offset, int $length = null): BitArray;
}
