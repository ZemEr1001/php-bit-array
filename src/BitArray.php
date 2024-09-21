<?php

namespace BitArray;

use ArrayAccess;

interface BitArray extends ArrayAccess
{
    public const BITS_IN_BYTE = 8;

    /**
     * Returns binary data as binary string
     *
     * @return string binary string
     */
    public function toString(): string;
}
