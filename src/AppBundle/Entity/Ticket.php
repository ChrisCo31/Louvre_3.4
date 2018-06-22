<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Ticket
 *
 * @ORM\Table(name="ticket")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TicketRepository")
 */
class Ticket
{
    //  Prix afferents aux limites d'ages & reductions

    const BABY_PRICE = 0;
    const CHILD_PRICE = 8;
    const ADULT_PRICE = 16;
    const SENIOR_PRICE = 12;
    const REDUCED_PRICE = 10;
    const HALF_DAY = 0.5;

    const HIGH_AGE_LIMIT_BABY = 4;
    const HIGH_AGE_LIMIT_CHILD = 12;
    const HIGH_AGE_LIMIT_ADULT = 59;
    const LOW_AGE_LIMIT_SENIOR = 60;
    // C'est le cote many d'une relation qui est proprietaire : plusieurs tickets par reservation donc l'entite ticket est le proprietaire
    //joincolumn a false pour interdire la creation de ticket sans reservation
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Reservation", inversedBy="tickets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $reservation;
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
     * @ORM\Column(name="firstName", type="string", length=255)
     * @Assert\Length(min=2, minMessage="message.name")
     * @Assert\NotBlank(message="message.name")
     */
    private $firstName;
    /**
     * @var string
     * @ORM\Column(name="lastName", type="string", length=255)
     * @Assert\Length(min=2, minMessage="message.name")
     * @Assert\NotBlank(message="message.name")
     */
    private $lastName;
    /**
     * @var \DateTime
     * @ORM\Column(name="birthDate", type="datetime")
     * @Assert\DateTime()
     * @Assert\NotBlank()
     * @Assert\LessThan("today", message="message.birthday")
     */
    private $birthDate;
    /**
     * @var string
     * @ORM\Column(name="country", type="string", length=255)
     * @Assert\Country(message="message.country")
     */
    private $country;
    /**
     * @var bool
     * @ORM\Column(name="discount", type="boolean")
     * @Assert\Type(type="bool")
     */
    private $discount;
    /**
     * @var int
     * @ORM\Column(name="price", type="integer")
     * @Assert\Type(type="int")
     */
    private $price;
    /**
     * Get id
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * Set firstName
     * @param string $firstName
     * @return Ticket
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }
    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }
    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return Ticket
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }
    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }
    /**
     * Set birthDate
     *
     * @param \DateTime $birthDate
     *
     * @return Ticket
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;

        return $this;
    }
    /**
     * Get birthDate
     *
     * @return \DateTime
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }
    /**
     * Set country
     *
     * @param string $country
     *
     * @return Ticket
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }
    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }
    /**
     * Set discount
     *
     * @param boolean $discount
     *
     * @return Ticket
     */
    public function setDiscount($discount)
    {
        $this->discount = $discount;

        return $this;
    }
    /**
     * Get discount
     *
     * @return bool
     */
    public function getDiscount()
    {
        return $this->discount;
    }
    /**
     * Set price
     *
     * @param integer $price
     *
     * @return Ticket
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }
    /**
     * Get price
     *
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
    }
    /**
     * Set reservation
     *
     * @param \AppBundle\Entity\Reservation $reservation
     *
     * @return Ticket
     */
    public function setReservation(\AppBundle\Entity\Reservation $reservation)
    {
        $this->reservation = $reservation;

        return $this;
    }
    /**
     * Get reservation
     * @return \AppBundle\Entity\Reservation
     */
    public function getReservation()
    {
        return $this->reservation;
    }
    /**
     * @return string
     */
    public function getAge($birthDate) // calcul de l'age par ticket
    {
        //$birthDate = $this->getBirthDate(); // renvoi null
        $today = new \DateTime(); // renvoi un objet(dateTime)
        // php.net/manual/fr/datetime.diff.php
        $delta = $birthDate->diff($today);
        $age = $delta->format('%Y%');
        return $age ;
    }
    /**
     * @param $ticket
     */
    public function calculatePricePerTicket($age, $discount = null) // integration du discount et calcul du prix par ticket
    {
        $discount = $this->getDiscount();
        $duration = $this->getReservation()->getDuration(); // on utilise la méthode getreservation de l'entité pour accéder à l'entité Réservation et ainsi accéder à ses méthodes
        if ($duration ==false)
        {
            if($discount AND ($age > self::HIGH_AGE_LIMIT_CHILD))
            {
                return self::REDUCED_PRICE;
            }
                return $this->givePriceFromAge($age);

        }else
        {
            if($discount AND ($age > self::HIGH_AGE_LIMIT_CHILD))
            {

                return ((self::REDUCED_PRICE)*(self::HALF_DAY));
            }
                return (($this->givePriceFromAge($age))*(self::HALF_DAY));
        }
    }
    /**
     * @param $age
     * @return int
     */
    private function givePriceFromAge($age) // Calcul du prix en fonction de l'age
    {
        if($age <= self::HIGH_AGE_LIMIT_BABY)
        {
            return self::BABY_PRICE;

        } elseif ($age <= self::HIGH_AGE_LIMIT_CHILD)
        {
            return self::CHILD_PRICE;

        } elseif ($age <= self::HIGH_AGE_LIMIT_ADULT)
        {
            return self::ADULT_PRICE;

        } elseif ($age >= self::LOW_AGE_LIMIT_SENIOR)
        {
            return self::SENIOR_PRICE;
        }
    }
}
