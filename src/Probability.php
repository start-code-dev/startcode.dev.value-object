<?php

namespace Startcode\ValueObject;

use Startcode\ValueObject\Exception\{InvalidProbabilityException, InvalidProbabilityOutcomeException};

class Probability extends IntegerNumber
{
    public const IMPOSSIBLE     = 0;
    public const MINIMAL_CHANCE = 1;
    public const CERTAIN        = 100;

    /**
     * @throws InvalidProbabilityException
     */
    public function __construct(int $value)
    {
        parent::__construct($value);
        if (!self::isValid($this->getValue())) {
            throw new InvalidProbabilityException($value);
        }
    }

    public static function isValid(float $value) : bool
    {
        return $value >= self::IMPOSSIBLE && $value <= self::CERTAIN;
    }

    public static function generateRandomWithChance() : Probability
    {
        return new static(random_int(self::MINIMAL_CHANCE, self::CERTAIN));
    }

    /**
     * @throws InvalidProbabilityOutcomeException
     */
    public function getOutcome(Dictionary $possibilities) : int
    {
        $mapOfChances = [];
        $previousValue = null;
        foreach ($possibilities->getAll() as $key => $value) {
            $mapOfChances[$key] = $value + $previousValue;
            $previousValue += $value;
        }
        foreach ($mapOfChances as $key => $value) {
            if ($this->getValue() <= $value) {
                return $key;
            }
        }
        throw new InvalidProbabilityOutcomeException($this->getValue(), json_encode($possibilities->getAll()));
    }
}
