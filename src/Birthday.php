<?php

namespace Startcode\ValueObject;

use Startcode\ValueObject\Exception\InvalidBirthdayException;

class Birthday
{
    private const OUTPUT_DATE_FORMAT = 'Y-m-d';

    private int $year;
    private int $month;
    private int $day;

    /**
     * @throws InvalidBirthdayException
     */
    public function __construct(int $year, int $month, int $day)
    {
        $currentYear = getdate(time())['year'];

        if ($year > $currentYear || ($year + 130 < $currentYear)) {
            throw new InvalidBirthdayException("Year $year, Month $month, Day $day");
        }
        if (checkdate($month, $day, $year) === false) {
            $month = 1;
            $day = 1;
        }
        $this->year     = $year;
        $this->month    = $month;
        $this->day      = $day;
    }

    public function getBirthdayDate() : \DateTime
    {
        return (new \DateTime())->setDate($this->year, $this->month, $this->day);
    }

    public static function create18() : Birthday
    {
        $aDate = (new \DateTime(date('Y-m-d', strtotime('18 years ago'))));
        return new self(
            $aDate->format('Y'),
            $aDate->format('m'),
            $aDate->format('d')
        );
    }

    public function getAge() : int
    {
        $now = new \DateTime();
        return $now->diff($this->getBirthdayDate())->y;
    }

    public function format($dateFormat = self::OUTPUT_DATE_FORMAT) : string
    {
        $aDate = (new \DateTime())->setDate($this->year, $this->month, $this->day);
        return $aDate->format($dateFormat);
    }

    /**
     * @throws InvalidBirthdayException
     */
    public static function makeFromString($birthdayString) : self
    {
        [$year, $month, $day] = explode('-', $birthdayString);
        return new self($year, $month, $day);
    }
}
