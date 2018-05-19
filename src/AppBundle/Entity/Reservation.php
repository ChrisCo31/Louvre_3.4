<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Validator as ReservationAssert;

/**
 * Reservation
 *
 * @ORM\Table(name="reservation")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ReservationRepository")
 */
class Reservation
{
    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Transaction", cascade={"all"})
     */
    private $transaction;
   /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Ticket", mappedBy ="Reservation", cascade={"all"})
     * @Assert\Valid()
     */
    private $tickets;
    /**
     * @var int
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @var string
     * @ORM\Column(name="email", type="string", length=255)
     * @Assert\Email(message="message.email")
     */
    private $email;
    /**
     * @var \DateTime
     * @ORM\Column(name="dateVisit", type="datetime")
     * @Assert\DateTime()
     * @Assert\NotBlank()
     * @ReservationAssert\ValidateDate
     * @ReservationAssert\ValidateVisitMax
     */
    private $dateVisit;
    /**
     * @var \DateTime
     * @ORM\Column(name="dateReservation", type="datetime")
     * @Assert\DateTime()
     * @Assert\NotBlank()
     */
    private $dateReservation; //ajout validation de la date
    /**
     * @var bool
     * @ORM\Column(name="duration", type="boolean")
     * @Assert\Type(type="bool")
     */
    private $duration;
    /**
     * @var int
     * @Assert\Range(
     *     min = 1,
     *     max = 10,
     *     minMessage = "message.min",
     *     maxMessage = "message.max")
     * @ORM\Column(name="nbTicket", type="integer")
     */
    private $nbTicket;
    /**
     * @var string
     * @ORM\Column(name="token", type="string", length=255)
     */
    private $token;
    /**
     * @var int
     * @ORM\Column(name="priceToPay", type="integer")
     * @Assert\Type(type="int")
     */
    private $priceToPay;
    /**
     * Reservation constructor.
     */
    public function __construct()
    {
        $this->dateReservation = new \Datetime();
        $this->tickets = new ArrayCollection();
        $this->setToken($this->generateToken());
       // if(!$this->getToken()) $this->setToken($this->generateToken());
    }
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * Set email
     *
     * @param string $email
     *
     * @return Reservation
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }
    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
    /**
     * Set dateVisit
     *
     * @param \DateTime $dateVisit
     *
     * @return Reservation
     */
    public function setDateVisit($dateVisit)
    {
        $this->dateVisit = $dateVisit;

        return $this;
    }
    /**
     * Get dateVisit
     *
     * @return \DateTime
     */
    public function getDateVisit()
    {
        return $this->dateVisit;
    }
    /**
     * Set dateReservation
     *
     * @param \DateTime $dateReservation
     *
     * @return Reservation
     */
    public function setDateReservation($dateReservation)
    {
        $this->dateReservation = $dateReservation;

        return $this;
    }
    /**
     * Get dateReservation
     *
     * @return \DateTime
     */
    public function getDateReservation()
    {
        return $this->dateReservation;
    }
    /**
     * Set duration
     *
     * @param boolean $duration
     *
     * @return Reservation
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }
    /**
     * Get duration
     *
     * @return bool
     */
    public function getDuration()
    {
        return $this->duration;
    }
    /**
     * Set nbTicket
     *
     * @param integer $nbTicket
     *
     * @return Reservation
     */
    public function setNbTicket($nbTicket)
    {
        $this->nbTicket = $nbTicket;

        return $this;
    }
    /**
     * Get nbTicket
     *
     * @return int
     */
    public function getNbTicket()
    {
        return $this->nbTicket;
    }
    /**
     * Set token
     *
     * @param string $token
     *
     * @return Reservation
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }
    /**
     * Get token
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }
    /**
     * generate a random token
     *
     *@return string
     */
    public function generateToken()
    {
        $alphabet = "azertyuiopqsdfghjklmwxcvbnAZERTYUIOPMLKJHGFDSQWXCVBN0123456789";
        $token = substr(str_shuffle(str_repeat($alphabet, 10)), 0, 10);
        return $token;
    }
    /**
     * Set priceToPay
     *
     * @param integer $priceToPay
     *
     * @return Reservation
     */
    public function setPriceToPay($priceToPay)
    {
        $this->priceToPay = $priceToPay;

        return $this;
    }
    /**
     * Get priceToPay
     *
     * @return int
     */
    public function getPriceToPay()
    {
        return $this->priceToPay;
    }
    /**
     * chek if the reservation has all tickets
     * @return bool
     */
    public function hasAllTicket()
    {
        if (count($this->getTickets()) == $this->getNbTicket() ) return true;
        return false;
    }
    /**
     * Add ticket
     *
     * @param \AppBundle\Entity\Ticket $ticket
     *
     * @return Reservation
     */
    public function addTicket(\AppBundle\Entity\Ticket $ticket)
    {
        $this->tickets[] = $ticket;
        // lie la reservation au ticket
        $ticket->setReservation($this);

        return $this;
    }
    /**
     * Remove ticket
     *
     * @param \AppBundle\Entity\Ticket $ticket
     */
    public function removeTicket(\AppBundle\Entity\Ticket $ticket)
    {
        $this->tickets->removeElement($ticket);
    }
    /**
     * Get tickets
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTickets()
    {
        return $this->tickets;
    }
    /**
     * Set transaction
     *
     * @param \AppBundle\Entity\Transaction $transaction
     *
     * @return Reservation
     */
    public function setTransaction(\AppBundle\Entity\Transaction $transaction = null)
    {
        $this->transaction = $transaction;

        return $this;
    }
    /**
     * Get transaction
     *
     * @return \AppBundle\Entity\Transaction
     */
    public function getTransaction()
    {
        return $this->transaction;
    }
}
