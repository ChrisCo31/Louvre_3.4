<?php
/**
 * Created by PhpStorm.
 * User: mishi
 * Date: 07/03/2018
 * Time: 19:03
 */

namespace AppBundle\Validator;
use Symfony\Component\Validator\Constraint;

/**
 * Class ConstraintDate
 * @package AppBundle\Validator
 * @Annotation
 */

class ConstraintDate extends Constraint
{
    public $msgClosingDay = 'Le mardi est le jour de fermeture';

    /**
     * @return string
     */
    public function validatedBy()
    {
        return 'app.dateValidator';
    }
}