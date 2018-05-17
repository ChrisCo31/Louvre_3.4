<?php
/**
 * Created by PhpStorm.
 * User: mishi
 * Date: 16/05/2018
 * Time: 11:14
 */

namespace AppBundle\Validator;

use AppBundle\Services\HalfDay;
use AppBundle\Services\InvalidBookingDate;
use AppBundle\Services\MaxTicketSold;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;


class ValidateDateValidator extends ConstraintValidator
{

        private $MaxTicketSold;
        private $Halfday;
        private $InvalidBookingDate;

    public function __construct(MaxTicketSold $MaxTicketSold, HalfDay $Halfday, InvalidBookingDate $InvalidBookingDate)
    {
        $this->MaxTicketSold = $MaxTicketSold;
        $this->Halfday = $Halfday;
        $this->InvalidBookingDate = $InvalidBookingDate;
    }

    public function validate($value, Constraint $constraint)
    {
        $nbTicket = $this->context->getRoot()->getData()->getnbTicket();
        $dateVisit = $this->context->getRoot()->getData()->getDateVisit();
        $reservation = $this->context->getRoot()->getData();
        if($this->MaxTicketSold->maxTicket($nbTicket, $dateVisit) == true)
        {
            $this->context->buildViolation($constraint->msgVisitMax)
                ->setParameter('{{ string }}', $value)
                ->addViolation();
        }
        if($this->Halfday->todayAfternoon($reservation) == true)
        {
            $this->context->buildViolation($constraint->msgHalfDay)
                ->setParameter('{{ string }}', $value)
                ->addViolation();
        }
        if($this->InvalidBookingDate->isClosing($dateVisit) == true)
        {
            $this->context->buildViolation($constraint->msgIsClosing)
                ->setParameter('{{ string }}', $value)
                ->addViolation();
        }
        if($this->InvalidBookingDate->isPast($dateVisit) == true)
        {
            $this->context->buildViolation($constraint->msgIsPast)
                ->setParameter('{{ string }}', $value)
                ->addViolation();
        }
        if($this->InvalidBookingDate->isBankHoliday($dateVisit) == true)
        {
            $this->context->buildViolation($constraint->msgIsBankHolyday)
                ->setParameter('{{ string }}', $value)
                ->addViolation();
        }
    }
}