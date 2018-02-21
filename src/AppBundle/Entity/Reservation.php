<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reservation
 *
 * @ORM\Table(name="reservation")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ReservationRepository")
 */
class Reservation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateVisit", type="datetimetz")
     */
    private $dateVisit;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateReservation", type="datetimetz")
     */
    private $dateReservation;

    /**
     * @var bool
     *
     * @ORM\Column(name="duration", type="boolean")
     */
    private $duration;

    /**
     * @var int
     *
     * @ORM\Column(name="nbTicket", type="integer")
     */
    private $nbTicket;

    /**
     * @var string
     *
     * @ORM\Column(name="token", type="string", length=255)
     */
    private $token;

    /**
     * @var int
     *
     * @ORM\Column(name="priceToPay", type="integer")
     */
    private $priceToPay;


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
}

