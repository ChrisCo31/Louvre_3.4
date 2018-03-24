<?php
/**
 * Created by PhpStorm.
 * User: mishi
 * Date: 23/03/2018
 * Time: 22:44
 */

namespace AppBundle\Services;
use AppBundle\Entity\Reservation;
use AppBundle\Entity\Ticket;

class GenerateTicket
{
    /**
     * @param $reservation
     */
    public function generateTicket($reservation)
    {
                for($i = 0; $i < $reservation->getNbTicket(); $i++)
                {
                    $reservation->addTicket(new Ticket());
                }
    }
}