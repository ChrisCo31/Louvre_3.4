<?php
/**
 * Created by PhpStorm.
 * User: mishi
 * Date: 28/03/2018
 * Time: 15:57
 */

namespace AppBundle\Services;

use AppBundle\Entity\Reservation;

class HalfDay
{
    /**
     * @param $reservation
     * @return bool
     */
    public function todayAfternoon($reservation)
    {
        //on va chercher l'atribut dateVisit de l'objet reservation et on le compare à $today (jour d'aujourd'hui) si = on regarde l'heure
        $today = New \DateTime('now');
        $dateVisit = $reservation->getDateVisit();
        $duration = $reservation->getDuration();

        if(($today->format('Y-m-d')) == ($dateVisit->format('Y-m-d')))
        {
            if ($today->format("H") >= 14 && $duration == false) //false correspond a la journee complete et true à la demijournee
            {
                return true; // return true si on est aujourd'hui apres midi
            }
        }
    }
}