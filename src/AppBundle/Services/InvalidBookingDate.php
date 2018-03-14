<?php
/**
 * Created by PhpStorm.
 * User: mishi
 * Date: 13/03/2018
 * Time: 15:29
 */

namespace AppBundle\Services;




class InvalidBookingDate
{
    /**
     * @param $dateVisit
     * @return bool
     */
    public function isClosing($dateVisit) // les reservations ne sont pas possible les mardis et dimanches
    {
        if ($dateVisit->format('D') == 'Tue' || $dateVisit->format('D') == 'Sun')
        {
            return true;
        } else {
            return false;
        }
    }
    /**
     * @param $dateVisit
     * @return bool
     */
    public function isPast($dateVisit) // les reservations ne sont pas possible à une date passée
    {
        $now = new \DateTime();
        if($dateVisit->format('Y-m-d') < $now->format('Y-m-d'))
        {
            return true;
        } else {
            return false;
        }
    }
    /**
     * @param $year
     * @return array
     */
    public function bankHoliday($year) // liste des jours féries fixes et variables en France
    {
        $easterDate  = easter_date($year); //function qui retourne un Timestamp pour Paques pour une année donnée
        $easterDay   = date('j', $easterDate);
        $easterMonth = date('n', $easterDate);
        $easterYear   = date('Y', $easterDate);
        $holidays = [
            // Dates fixes
            // function mktime qui retourne un timestamp des arguments donnés
            mktime(0, 0, 0, 1,  1,  $year),  // 1er janvier
            mktime(0, 0, 0, 5,  1,  $year),  // Fête du travail
            mktime(0, 0, 0, 5,  8,  $year),  // Victoire des alliés
            mktime(0, 0, 0, 7,  14, $year),  // Fête nationale
            mktime(0, 0, 0, 8,  15, $year),  // Assomption
            mktime(0, 0, 0, 11, 1,  $year),  // Toussaint
            mktime(0, 0, 0, 11, 11, $year),  // Armistice
            mktime(0, 0, 0, 12, 25, $year),  // Noel
            // Dates variables
            mktime(0, 0, 0, $easterMonth, $easterDay + 2,  $easterYear), // le lundi de Paques
            mktime(0, 0, 0, $easterMonth, $easterDay + 40, $easterYear), // le jeudi de l'ascension
            mktime(0, 0, 0, $easterMonth, $easterDay + 50, $easterYear), // le lundi de pentecote
        ];
        sort($holidays);
        return $holidays;
    }
    /**
     * @param $dateVisit
     * @return bool
     */
    public function isBankHoliday($dateVisit)
    {
        // function in_array qui permet de compare si la valeur $dateVisit se trouve dans le tableau de la fonction "bankHolidau"
        if (in_array($dateVisit->getTimestamp(), $this->bankHoliday($dateVisit->format('Y')))) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * @param $reservation
     * @return bool
     */
    Public function isHalfDay($reservation)
    {
        //on va chercher l'atribut dateVisit de l'objet reservation et on le compare à $today (jour d'aujourd'hui) si c'est le cas, on regarde l'heure
        $today = New \DateTime('now');
        if($today->format('Y-m-d') == $reservation->getDateVisit()->format('Y-m-d'))
        {
            if ($today->format('H') >= 14)
            {
                return true;
            }
        }
    }

}