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

class PriceCalculator
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

    public function __construct()
    {
        $ticket = new Ticket();
        $this->ticket = $ticket;
    }

    /**
     * @param $age
     * @return int
     */
    private function pricePerAge($ticket, $birthDate) // Calcul du prix en fonction de l'age
   {
       $age = $ticket->getAge($birthDate);
       var_dump($age);

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
    public function pricePerTicket($age, $reduction = null) // integration du discount et calcul du prix par ticket
   {
       /*if($ticket->getDiscount())
       {
           return self::REDUCED_PRICE;
       } else
       {*/
           return $pricePerTicket = $this->pricePerAge($age);

   }

    /**
     * @param Reservation $reservation
     */
    public function pricePerReservation($age, $reservation) //calcul du prix par reservation incluant la demi journee
    {
        $total = $reservation->getPriceToPay();
        foreach($reservation->getTickets() as $ticket)
        {
            $pricePerTicket = $this->pricePerTicket($age);
            $total += $pricePerTicket;
            echo $total;
            exit();
        }
    }
}