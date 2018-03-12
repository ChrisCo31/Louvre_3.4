<?php
/**
 * Created by PhpStorm.
 * User: mishi
 * Date: 07/03/2018
 * Time: 19:19
 */

namespace AppBundle\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use AppBundle\Services\ClosingDay;

class DateValidator extends ConstraintValidator
{
    private $closingDay;

    /**
     * DateValidator constructor.
     * @param ClosingDay $closingDay
     */
    public function __construct(ClosingDay $closingDay)
    {
        $this->closingDay = $closingDay;
    }
    /**
     * Checks if the passed value is valid.
     *
     * @param mixed $value The value that should be validated
     * @param Constraint $constraint The constraint for the validation
     */
    public function validate($value, Constraint $constraint= null)
    {
        if ($this->closingDay->isTuesday($value)== true)
        {
            $this->context->buildViolation($this->closingDay->msgClosingDay)
            ->setParameter('{{ string }}', $value)
            ->addViolation();

        }
    }
}