<?php

namespace BitArray;

use ArrayAccess;
use Countable;

interface BitArray extends ArrayAccess, Countable
{
    public const BITS_IN_BYTE = 8;

    /**
     * Returns binary data as binary string
     *
     * @return string binary string
     */
    public function toString(): string;
}
