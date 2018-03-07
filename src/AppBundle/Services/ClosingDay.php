<?php
/**
 * Created by PhpStorm.
 * User: mishi
 * Date: 01/03/2018
 * Time: 12:01
 */
namespace AppBundle\Services;

class ClosingDay
{
    /**
     * @param $dateVisit
     */
    public function isTuesday($dateVisit)
    {
        if ($dateVisit->format('D') == 'Tue' )
        {
            return true;
        } else {
            return false;
        }
    }
}