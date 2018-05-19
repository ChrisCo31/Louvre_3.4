<?php
/**
 * Created by PhpStorm.
 * User: mishi
 * Date: 19/05/2018
 * Time: 16:36
 */

namespace AppBundle\Validator;


use AppBundle\Services\HalfDay;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ValidateDurationValidator extends ConstraintValidator
{
    private $HalfDay;
    public function __construct(HalfDay $HalfDay)
    {
        $this->HalfDay = $HalfDay;
    }
    public function validate($value, Constraint $constraint)
    {
        $reservation = $this->context->getRoot()->getData();
        if($this->HalfDay->todayAfternoon($reservation) === true)
        {
            $this->context->buildViolation($constraint->msgDuration)
                ->addViolation();
        }
    }
}