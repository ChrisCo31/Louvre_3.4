<?php
/**
 * Created by PhpStorm.
 * User: mishi
 * Date: 08/06/2018
 * Time: 09:47
 */

namespace AppBundle\Services;
use AppBundle\Entity\Reservation;
use AppBundle\Entity\Ticket;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Session;

class BookingManager
{
    private $session;

    public function __construct(SessionInterface $session, $calculPrice)
    {
        $this->session = $session;
        $this->PriceCalculator = $calculPrice;
    }
    /**
     * save in session the reservation
     * @param $reservation
     */
    public function saveReservation(Reservation $reservation)
    {
       $this->session->set('reservation', $reservation);
    }
    /**
     * @param $request
     * @return mixed
     */
    public function retrieveReservation()
    {
        $reservation = $this->session->get('reservation');
        return $reservation;
    }
    public function generateTickets($reservation)
    {
        for($i = 0; $i < $reservation->getNbTicket(); $i++)
        {
            $reservation->addTicket(new Ticket());
        }
    }
    public function calculPrice($reservation)
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
