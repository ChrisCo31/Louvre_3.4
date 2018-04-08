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
    /**
     * @param Reservation $reservation
     */
    public function calculateTotalPrice($reservation) //calcul du prix par reservation incluant la demi journee
    {
        //recuperation de tous les tickets
        $tickets = $reservation->getTickets();
        $totalPrice = 0;
        foreach ($tickets as $ticket)
        {
            $birthDate = $ticket->getbirthDate(); // on va chercher l'objet datetime
            // Calcul de l'age
            $age = $ticket->getAge($birthDate); // on appelle la methode getAge de l'entite Ticket avec la date de naissance en parametre
            $price = $ticket->calculatePricePerTicket($age);
            $affectPrice = $ticket->setPrice($price); // il serait plus judicieux d'hydrater les objets tickets avec leur prix à un autre endroit...
            $totalPrice = $totalPrice + $price;
        }
        $totalPrice = $reservation->setPriceToPay($totalPrice);
        return $totalPrice;
    }
}

