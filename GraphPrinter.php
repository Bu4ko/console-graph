<?php declare(strict_types=1);

include 'GraphCalculationsHelper.php';

class GraphPrinter
{
    public const DEFAULT_STRING_SIZE = 80;

    public const DEFAULT_VALUES_ARRAY = [
        1.1066, 1.1048, 1.1023, 1.1003, 1.0969, 1.0951, 1.0901, 1.0914, 1.0867, 1.0842, 1.0835, 1.0816, 1.08, 1.079,
        1.0801, 1.0818, 1.084, 1.0875, 1.0964, 1.0977, 1.1122, 1.1117, 1.1125, 1.1187, 1.1336, 1.1456, 1.139, 1.1336,
        1.124, 1.1104, 1.1157, 1.0982, 1.0934, 1.0801, 1.0707, 1.0783, 1.0843, 1.0827, 1.0981, 1.0977, 1.1034, 1.0956,
        1.0936, 1.0906, 1.0785, 1.0791, 1.0885, 1.0871, 1.0867, 1.0963
    ];

    /** @var float[]  */
    private array $values = self::DEFAULT_VALUES_ARRAY;

    private int $stringSize = self::DEFAULT_STRING_SIZE;

    public function readUserInput(): void
    {
        $this->readUserInputStringSize();
        $this->readUserInputArray();
    }

    public function printGraph(): void
    {
        $valuesDTO = GraphCalculationsHelper::getMinMaxValueDTO($this->values);
        $range = GraphCalculationsHelper::getRange($valuesDTO);
        $step = GraphCalculationsHelper::getStep($range, $this->stringSize);

        foreach ($this->values as $valueToOutput) {
            $stringToOutput = $this->combineStringForOutput($valueToOutput, $valuesDTO->getMinValue(), $step);
            printf($stringToOutput . PHP_EOL);
        }
    }

    private function combineStringForOutput(float $valueToOutput, float $minValue, float $step) {
        $prefixSpaces = (int)round(($valueToOutput - $minValue) / $step);
        // - 1 as last char of each string will be dot
        return str_pad('', $prefixSpaces - 1) . '*';
    }

    private function readUserInputArray(): void
    {
        $userInput = readline('Enter values array (space separated) or skip for default ');
        if (empty($userInput)) {
            return;
        }

        $userInputArray = explode(' ', $userInput);
        $this->convertInputArrayToFloat($userInputArray);
        $this->values = $userInputArray;
    }

    private function readUserInputStringSize(): void
    {
        $userInputStringSize = readline('Enter string size (integer) or skip for default ');
        if (!empty($userInputStringSize) && is_numeric($userInputStringSize)) {
            $this->stringSize = (int)$userInputStringSize;
        }
    }

    /**
     * @param string[] $userInputArray
     */
    private function convertInputArrayToFloat(array &$userInputArray): void
    {
        foreach ($userInputArray as $key => $value) {
            if (!is_numeric($value)) {
                throw new Exception('Array should have only numeric values');
            }
            $userInputArray[$key] = (float)$value;
        }
    }
}
