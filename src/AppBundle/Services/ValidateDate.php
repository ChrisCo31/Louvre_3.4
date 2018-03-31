<?php
/**
 * Created by PhpStorm.
 * User: mishi
 * Date: 28/03/2018
 * Time: 13:47
 */

namespace AppBundle\Services;

use AppBundle\Services\InvalidBookingDate;

class ValidateDate
{
    private $invalidBookingDate;
    public function __construct ($invalidBookingDate)
    {
        $this->invalidBookingDate = $invalidBookingDate;
    }
    private $message = [];
    /**
     * @param $value
     * @return string
     */
    Public function checkDay($value)
    {
        if($this->invalidBookingDate->isClosing($value) == true )
        {
            $message = "le musee est fermé les mardis et dimanches";
            return $message;
        }
        if($this->invalidBookingDate->isPast($value) == true )
        {
            $message = "reservation impossible pour les jours passés";
            return $message;
        }
        if($this->invalidBookingDate->isBankHoliday($value) == true )
        {
            $message = "reservation impossible pour les jours feries";
            return $message;
        }
    }
}