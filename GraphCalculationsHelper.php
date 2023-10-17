<?php declare(strict_types=1);

include 'MinMaxValuesDTO.php';

class GraphCalculationsHelper
{
    public static function getRange(MinMaxValuesDTO $dto): float
    {
        return $dto->getMaxValue() - $dto->getMinValue();
    }

    public static function getStep(float $range, int $stringSize): float
    {
        return $range / $stringSize;
    }

    public static function getMinMaxValueDTO(array $values): MinMaxValuesDTO
    {
        $minval = $maxval = $values[0];

        foreach ($values as $value) {
            if (!is_numeric($value)) {
                throw new Exception('Array should have only numeric values');
            }
            if ($minval > $value) {
                $minval = $value;
            }
            if ($maxval < $value) {
                $maxval = $value;
            }
        }

        return new MinMaxValuesDTO((float)$minval, (float)$maxval);
    }
}
