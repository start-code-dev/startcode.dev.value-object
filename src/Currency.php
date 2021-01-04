<?php

namespace Startcode\ValueObject;

use Startcode\ValueObject\Constants\Currencies;
use Startcode\ValueObject\Exception\InvalidCurrencyException;

class Currency
{
    private string $value;

    private $currencyMap = [
        'EUR' => [
            Currencies::CURRENCY_TITLE  => 'Euro',
            Currencies::CURRENCY_SYMBOL => '€',
            Currencies::CURRENCY_ISO    => 978
        ],
        'CHF' => [
            Currencies::CURRENCY_TITLE  => 'Swiss Franc',
            Currencies::CURRENCY_SYMBOL => 'Fr',
            Currencies::CURRENCY_ISO    => 756
        ],
        'USD' => [
            Currencies::CURRENCY_TITLE  => 'US Dollar',
            Currencies::CURRENCY_SYMBOL => '$',
            Currencies::CURRENCY_ISO    => 840
        ],
        'DKK' => [
            Currencies::CURRENCY_TITLE  => 'Danish krone',
            Currencies::CURRENCY_SYMBOL => 'kr',
            Currencies::CURRENCY_ISO    => 208
        ],
        'NOK' => [
            Currencies::CURRENCY_TITLE  => 'Norwegian krone',
            Currencies::CURRENCY_SYMBOL => 'kr',
            Currencies::CURRENCY_ISO    => 578
        ],
        'SEK' => [
            Currencies::CURRENCY_TITLE  => 'Swedish krona',
            Currencies::CURRENCY_SYMBOL => 'kr',
            Currencies::CURRENCY_ISO    => 752
        ],
        'GBP' => [
            Currencies::CURRENCY_TITLE  => 'British Pound',
            Currencies::CURRENCY_SYMBOL => '£',
            Currencies::CURRENCY_ISO    => 826
        ],
    ];

    /**
     * @throws InvalidCurrencyException
     */
    public function __construct(string $value)
    {
        if (!array_key_exists($value, $this->currencyMap)) {
            throw new InvalidCurrencyException($value);
        }
        $this->value = $value;
    }

    public function __toString() : string
    {
        return $this->value;
    }

    public function getTitle() : string
    {
        return $this->currencyMap[$this->value][Currencies::CURRENCY_TITLE];
    }

    public function getSymbol() : string
    {
        return $this->currencyMap[$this->value][Currencies::CURRENCY_SYMBOL];
    }

    public function getISO() : int
    {
        return $this->currencyMap[$this->value][Currencies::CURRENCY_ISO];
    }
}
