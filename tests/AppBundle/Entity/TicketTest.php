<?php
/**
 * Created by PhpStorm.
 * User: mishi
 * Date: 12/04/2018
 * Time: 17:13
 */

namespace Tests\AppBundle\Entity;


use AppBundle\Entity\Ticket;
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
        $ticket->setBirthDate("2010-10-10");
        $ticket->getAge($ticket);

        $this->assertEquals("8", $ticket);
    }
}

