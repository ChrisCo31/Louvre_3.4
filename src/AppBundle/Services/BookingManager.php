<?php
/**
 * Created by PhpStorm.
 * User: mishi
 * Date: 08/06/2018
 * Time: 09:47
 */

namespace AppBundle\Services;
use AppBundle\Entity\Reservation;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Session;

class BookingManager
{
    private $session;

    public function __construct(SessionInterface $session, $generateTicket, $calculPrice)
    {
        $this->session = $session;
        $this->GenerateTicket = $generateTicket;
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
        $this->GenerateTicket->generateTicket($reservation);
    }
    public function calculPrice($reservation)
    {
        $this->PriceCalculator->calculateTotalPrice($reservation);
    }
    public function updateReservation($reservation)
    {
        $this->generateTickets();
        $this->calculPrice();
    }
}
