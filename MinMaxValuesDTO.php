<?php declare(strict_types=1);

class MinMaxValuesDTO
{
    public function __construct(private float $minValue, private float $maxvalue)
    {
    }

    public function getMinValue(): float
    {
        return $this->minValue;
    }

    public function getMaxValue(): float
    {
        return $this->maxvalue;
    }
}
