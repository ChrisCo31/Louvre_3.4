<?php
/**
 * Created by PhpStorm.
 * User: mishi
 * Date: 22/03/2018
 * Time: 08:49
 */

namespace AppBundle\Services;


use AppBundle\Entity\Reservation;
use AppBundle\Entity\Ticket;

class Price
{
    //  Prix afferents aux limites d'ages & reductions

    const BABY_PRICE = 0;
    const CHILD_PRICE = 8;
    const ADULT_PRICE = 16;
    const SENIOR_PRICE = 12;
    const REDUCED_PRICE = 10;
    const HALF_DAY = 0.5;

    const HIGH_AGE_LIMIT_BABY = 4;
    const HIGH_AGE_LIMIT_CHILD = 12;
    const HIGH_AGE_LIMIT_ADULT = 59;
    const LOW_AGE_LIMIT_SENIOR = 60;


    /**
     * @param $ticket
     */
    private function ageCalculation($ticket) // calcul de l'age par ticket
   {
       $birthDate = $ticket->getBirthDate();
       $today = new \DateTime();
       $delta = $birthDate->diff($today);
       $age = $delta->format('Y');
       return $age ;
   }
    /**
     * @param $age
     * @return int
     */
    private function pricePerAge($age) // Calcul du prix en fonction de l'age
   {
       if($age <= self::HIGH_AGE_LIMIT_BABY)
       {
           return self::BABY_PRICE;

       } elseif ($age <= self::HIGH_AGE_LIMIT_CHILD)
       {
           return self::CHILD_PRICE;

       } elseif ($age <= self::HIGH_AGE_LIMIT_ADULT)
       {
           return self::ADULT_PRICE;

       } elseif ($age >= self::LOW_AGE_LIMIT_SENIOR)
       {
           return self::SENIOR_PRICE;
       }
   }

    /**
     * @param $ticket
     */
    public function pricePerTicket($ticket) // integration du discount et calcul du prix par ticket
   {
       if($ticket->getDiscount())
       {
           return self::REDUCED_PRICE;
       } else
       {
           return $pricePerTicket = $this->pricePerAge($this->ageCalculation($ticket));
       }
   }

    /**
     * @param Reservation $reservation
     */
    public function pricePerReservation(Reservation $reservation) //calcul du prix par reservation incluant la demi journee
    {
        $reservation->setPriceToPay(0);
        foreach($reservation->getTickets() as $ticket)
        {
            $priceTicket = $this->pricePerTicket($ticket);
            if($reservation->getDuration())
            {
                $priceTicket = self::HALF_DAY;
            } else
            {

            }
        }
    }

}