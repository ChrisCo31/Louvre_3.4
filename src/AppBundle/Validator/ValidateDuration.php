<?php
/**
 * Created by PhpStorm.
 * User: mishi
 * Date: 19/05/2018
 * Time: 16:34
 */

namespace AppBundle\Validator;


use Symfony\Component\Validator\Constraint;
/**
 * @Annotation
 */

class ValidateDuration extends Constraint
{
    public $msgDuration = 'Réservation possible uniquement pour la demi-journee';
}