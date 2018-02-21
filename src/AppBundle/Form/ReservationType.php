<?php
/**
 * Created by PhpStorm.
 * User: mishi
 * Date: 19/02/2018
 * Time: 16:55
 */

namespace AppBundle\Form;

use Symfony\Bundle\FrameworkBundle\Tests\Fixtures\Validation\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nbTicket', IntegerType::class, [
                'label' => 'Combien de ticket'
                ]
            )
            ->add ('dateVisit', DateType::class, [
                'label' => 'Date de visite souhaitée :'
            ])
            ->add('duration', ChoiceType::class,  [
                'label' => 'Désirez-vous un billet journée ou demi-journée ?',
                'choices' => [
                    'Billet demi-journée' => true,
                    'Billet journée complète' => false,
                ]
            ])
            ->add('email', RepeatedType::class, [
                'type' => EmailType::class,
                'invalid_message' => 'The email fields must match',
                'options' => array('attr' =>array('class' =>'email-field')),
                'required' => true,
                'first_options' =>array('label' =>'email'),
                'second_options'=>array('label' =>'Repeat email'),
            ])
            ->add('save', SubmitType::class);
    }
}