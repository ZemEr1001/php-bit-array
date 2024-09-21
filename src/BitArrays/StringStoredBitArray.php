<?php

namespace BitArray\BitArrays;

use BitArray\BitArray;
use InvalidArgumentException;
use RangeException;
use UnexpectedValueException;

class StringStoredBitArray implements BitArray
{
    private $data;
    private $length;

    public function __construct($length)
    {
        if ($length > PHP_INT_MAX) {
            throw new RangeException('Length must be less or equal '.PHP_INT_MAX);
        }

        $this->checkIsPositiveInteger($length);

        $this->length = $length;
        $numberOfByte = (int) ceil($length / self::BITS_IN_BYTE);
        $this->data = str_repeat(chr(0), $numberOfByte);
    }

    public function toString(): string
    {
        return $this->data;
    }

    /**
     * @inheritdoc
     */
    public function offsetExists($offset)
    {
        if (!is_int($offset)) {
            return false;
        }

        if ($offset < 0) {
            return false;
        }

        if ($offset > $this->length - 1) {
            return false;
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function offsetGet($offset)
    {
        $this->checkIsValidOffset($offset);

        $mask = $this->generateBitMask($offset);
        $byte = $this->getContainingByte($offset);
        $bit = (bool) ($byte & $mask);

        return $bit;
    }
    public function offsetSet($offset, $value)
    {
        $this->checkIsValidOffset($offset);
        $bit = (bool) $value;

        $mask = $this->generateBitMask($offset);
        $byte = $this->getContainingByte($offset);

        $byte = $bit
        ? $byte | $mask
        : $byte & (0b11111111 ^ $mask);

        $this->data[$this->getContainingByteIndex($offset)] = chr($byte);
    }
    public function offsetUnset($offset)
    {
        $this->offsetSet($offset, false);
    }
    public function count()
    {
        return $this->length;
    }

    private function checkIsPositiveInteger($number)
    {
        if (!is_int($number)) {
            throw new UnexpectedValueException('Value must be an integer.');
        }

        if ($number < 0) {
            throw new RangeException('Value must be greater than zero.');
        }
    }

    private function checkIsValidOffset($number)
    {
        $this->checkIsPositiveInteger($number);

        if ($number >= $this->length) {
            throw new RangeException('Value must be less than array length - 1.');
        }
    }

    private function getContainingByte($bitIndex)
    {
        $byteIndex = $this->getContainingByteIndex($bitIndex);
        $byte = ord($this->data[$byteIndex]);

        return $byte;
    }

    private function getContainingByteIndex($bitIndex)
    {
        return (int) floor($bitIndex / self::BITS_IN_BYTE);
    }

    private function generateBitMask($number)
    {
        return (int) pow(2, $number % static::BITS_IN_BYTE);
    }
}
