<?php
/**
 * Created by PhpStorm.
 * User: mishi
 * Date: 16/05/2018
 * Time: 11:14
 */

namespace AppBundle\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ValidateDateValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if($this->MaxTicketSold->maxTicket($value) == true)
        {
            $this->context->buildViolation($constraint->$msgVisitMax)
                ->setParameter($msgVisitMax, $value)
                ->addViolation();
        }
        if($this->Halfday->todayAfternoon($value)== true)
        {
            $this->context->buildViolation($constraint->$msgHalfDay)
                ->setParameter($msgHalfDay, $value)
                ->addViolation();
        }
        if($this->InvalidBookingDate->isClosing($value) == true)
        {
            $this->context->buildViolation($constraint->$msgIsClosing)
                ->setParameter($msgIsClosing, $value)
                ->addViolation();
        }
        if($this->InvalidBookingDate->isPast($value) == true)
        {
            $this->context->buildViolation($constraint->$msgIsPast)
                ->setParameter($msgIsPast, $value)
                ->addViolation();
        }
        if($this->InvalidBookingDate->isBankHoliday($value) == true)
        {
            $this->context->buildViolation($constraint->$msgIsBankHollyday)
                ->setParameter($msgIsBankHollyday, $value)
                ->addViolation();
        }
    }

}