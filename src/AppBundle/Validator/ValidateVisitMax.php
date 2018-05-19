<?php
/**
 * Created by PhpStorm.
 * User: mishi
 * Date: 19/05/2018
 * Time: 15:27
 */

namespace AppBundle\Validator;
use Symfony\Component\Validator\Constraint;
/**
 * @Annotation
 */
class ValidateVisitMax extends Constraint
    {
        public $msgVisitMax = 'Nombre maximum de visiteurs atteint ce jour';
    }