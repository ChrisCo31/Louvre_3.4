<?php
/**
 * Created by PhpStorm.
 * User: mishi
 * Date: 23/03/2018
 * Time: 18:06
 */

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;


class ReservationIdentifyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tickets', CollectionType::class, array(
                    'entry_type' => TicketType::class)
            )
            ->add('Ajouter', SubmitType::class);
    }
}