<?php
/**
 * Created by PhpStorm.
 * User: mishi
 * Date: 19/05/2018
 * Time: 15:31
 */

namespace AppBundle\Validator;


use AppBundle\Services\MaxTicketSold;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ValidateVisitMaxValidator extends ConstraintValidator
{
    private $MaxTicketSold;
    public function __construct(MaxTicketSold $MaxTicketSold)
    {
        $this->MaxTicketSold = $MaxTicketSold;
    }
    public function validate($value, Constraint $constraint)
    {
        $dateVisit = $this->context->getRoot()->getData()->getDateVisit();
        $nbTicket = $this->context->getRoot()->getData()->getnbTicket();
        if($this->MaxTicketSold->MaxTicket($dateVisit, $nbTicket) === true)
        {
            $this->context->buildViolation($constraint->msgVisitMax)
                ->addViolation();
        }
    }
}