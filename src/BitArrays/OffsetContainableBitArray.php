<?php

namespace BitArray\BitArrays;

use BitArray\BitArray;

class OffsetContainableBitArray implements BitArray
{
    private $bitArray;
    private $firstBitPosition;

    public function __construct(int $firstBitPosition, BitArray $bitArray)
    {
        $this->firstBitPosition = $firstBitPosition;
        $this->bitArray = $bitArray;
    }

    public function toString(): string
    {
        return $this->bitArray->toString();
    }

    public function getFirstBitPosition()
    {
        return $this->firstBitPosition;
    }

    /**
     * {@inheritdoc}
     */
    public function offsetExists($offset)
    {
        if ($this->isOfsetBeforeFirstBitPosition($offset)) {
            return true;
        }
        return $this->bitArray->offsetExists($offset - $this->firstBitPosition);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetGet($offset)
    {
        if ($this->isOfsetBeforeFirstBitPosition($offset)) {
            return false;
        }

        return $this->bitArray->offsetGet($offset - $this->firstBitPosition);
    }
    public function offsetSet($offset, $value)
    {
        if ($this->isOfsetBeforeFirstBitPosition($offset)) {
            return;
        }

        return $this->bitArray->offsetSet($offset - $this->firstBitPosition, $value);
    }
    public function offsetUnset($offset)
    {
        if ($this->isOfsetBeforeFirstBitPosition($offset)) {
            return;
        }

        return $this->bitArray->offsetSet($offset - $this->firstBitPosition, false);
    }
    public function count()
    {
        return $this->bitArray->count() + $this->firstBitPosition;
    }

    private function isOfsetBeforeFirstBitPosition(int $offset)
    {
        return $offset > 0 && $offset < $this->firstBitPosition;
    }
}
