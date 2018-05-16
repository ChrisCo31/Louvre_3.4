<?php
/**
 * Created by PhpStorm.
 * User: mishi
 * Date: 12/04/2018
 * Time: 17:13
 */

namespace Tests\AppBundle\Entity;


use AppBundle\Entity\Ticket;
use AppBundle\Form\ReservationIdentifyType;
use PHPUnit\Framework\TestCase;

class TicketTest extends TestCase
{
    public function testSetFirstName()
    {
        // instancier la classe
        $ticket = new Ticket();
        $firstName = "chris" ;
        // executer la methode
        $ticket->setFirstName($firstName);

        // verifier que la sortie est correcte
        $this->assertEquals("chris", $ticket->getFirstName());
    }
    public function testSetBirthDate()
    {
        $ticket = new Ticket();
        $birthDate = "1970-10-06" ;
        $ticket->setBirthDate($birthDate);

        $this->assertEquals("1970-10-06", $ticket->getBirthDate());
    }
    public function testGetAge()
    {
        $ticket = new Ticket();
        $birthDate = new \DateTime(date('2000-10-10'));
        $ticket->setBirthDate($birthDate);
        $age = $ticket->getBirthDate();
        $ticket = $ticket->getAge($age);

        $this->assertEquals("17", $ticket);
    }
    /*public function testCalculatePricePerTicket()
    {
        $ticket = new Ticket();
        $duration = true;
        $ticket = $ticket->calculatePricePerTicket('20');

        $this->assertEquals("16", $ticket);
    }*/
}

