<?php
/**
 * Created by PhpStorm.
 * User: mishi
 * Date: 16/05/2018
 * Time: 11:14
 */

namespace AppBundle\Validator;

use AppBundle\Services\InvalidBookingDate;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;


class ValidateDateValidator extends ConstraintValidator
{
       private $InvalidBookingDate;

    public function __construct( InvalidBookingDate $InvalidBookingDate)
    {
        $this->InvalidBookingDate = $InvalidBookingDate;
    }

    public function validate($value, Constraint $constraint)
    {
        $dateVisit = $this->context->getRoot()->getData()->getDateVisit();
        if($this->InvalidBookingDate->isClosing($dateVisit) === true)
        {
            $this->context->buildViolation($constraint->msgIsClosing)
                ->setParameter('{{ madate }}', $value->format('d-m-Y'))
                ->addViolation();
        }

        if($this->InvalidBookingDate->isPast($dateVisit) === true)
        {
            $this->context->buildViolation($constraint->msgIsPast)
                ->addViolation();
        }
        if($this->InvalidBookingDate->isBankHoliday($dateVisit) === true)
        {
            $this->context->buildViolation($constraint->msgIsBankHolyday)
                ->setParameter('{{ string }}', $value->format('d-m-Y'))
                ->addViolation();
        }
    }
}