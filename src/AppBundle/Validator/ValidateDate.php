<?php
/**
 * Created by PhpStorm.
 * User: mishi
 * Date: 16/05/2018
 * Time: 11:06
 */

namespace AppBundle\Validator;
use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ValidateDate extends Constraint
{
    public $msgIsClosing = 'la reservation n\'est pas possible le {{ madate }}';
    public $msgIsPast = 'la reservation n\'est pas possible pour les jours passés';
    public $msgIsBankHolyday = 'la reservation est impossible les jours fériés';

    //public $message ='ca marche pas {{ montexte }}';
}