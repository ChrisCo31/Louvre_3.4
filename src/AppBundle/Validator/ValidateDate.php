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
    public $msgVisitMax = 'message.visitMax';
    public $msgHalfDay = 'message.halfday';
    public $msgIsClosing = 'la reservation n\'est pas possible les mardis et dimanches';
    public $msgIsPast = 'la reservation n\'est pas possible pour les jours passés';
    public $msgIsBankHolyday = 'la reservation est impossible les jours fériés';
}