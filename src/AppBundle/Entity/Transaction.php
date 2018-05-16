<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Transaction
 * @ORM\Table(name="transaction")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TransactionRepository")
 */
class Transaction
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
     * @var int
     *
     * @ORM\Column(name="statusCode", type="integer")
     */
    private $statusCode;
    /**
     * @var string
     *
     * @ORM\Column(name="message", type="string", length=255)
     */
    private $message;
    /**
     * @var string
     *
     * @ORM\Column(name="idStripe", type="string", length=255)
     */
    private $idStripe;
    /**
     * Transaction constructor.
     */
    public function __construct()
    {
        $this->statusCode = 000;
        $this->message = "En attente";
        $this->idStripe = "0";
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
     * Set statusCode
     *
     * @param integer $statusCode
     *
     * @return Transaction
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }
    /**
     * Get statusCode
     *
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }
    /**
     * Set message
     *
     * @param string $message
     *
     * @return Transaction
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }
    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }
    /**
     * Set idStripe
     *
     * @param string $idStripe
     *
     * @return Transaction
     */
    public function setIdStripe($idStripe)
    {
        $this->idStripe = $idStripe;

        return $this;
    }
    /**
     * Get idStripe
     *
     * @return string
     */
    public function getIdStripe()
    {
        return $this->idStripe;
    }
}

