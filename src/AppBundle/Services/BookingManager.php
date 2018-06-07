<?php
/**
 * Created by PhpStorm.
 * User: mishi
 * Date: 06/06/2018
 * Time: 15:08
 */

namespace AppBundle\Services;

use AppBundle\Entity\Reservation;
use AppBundle\Entity\Ticket;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class BookingManager
{
    private $session;
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }
    public function getSession()
    {
        if($this->session->has('reservation'))
        {
            if($this->session->get('reservation') instanceof Reservation)
            {
                return $this ->session->get('reservation');
            }
        }
        return null;
    }
    public function getReservation()
    {
        $reservation = $this->getSession();
        return $reservation;
    }
}
