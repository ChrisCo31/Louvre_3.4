<?php
/**
 * Created by PhpStorm.
 * User: mishi
 * Date: 14/03/2018
 * Time: 17:21
 */

namespace AppBundle\Services;

use AppBundle\Entity\Reservation;
use Doctrine\ORM\EntityManagerInterface;

class MaxTicketSold
{
    private $em;
    /**
     * InvalidBookingDate constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    /**
     * @param $dateVisit
     * @param $nbTicket
     * @return bool
     */
    public function maxTicket($dateVisit, $nbTicket)
    {
        //SQL SELECT COUNT(nbTicket) FROM reservation WHERE dateVisit = $dateVisit
        $nbTicketSold = $this->em->getRepository('AppBundle:Reservation')->countTicketSold($dateVisit);
        if(($nbTicketSold + $nbTicket) > 1000)
        {
            return true;
        } else {
            return false;
        }
    }


}