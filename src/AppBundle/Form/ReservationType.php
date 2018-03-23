<?php
/**
 * Created by PhpStorm.
 * User: mishi
 * Date: 19/02/2018
 * Time: 16:55
 */

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;


class ReservationType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // mettre un cadre : entre 1 et 10 tickets
            ->add('nbTicket', IntegerType::class, array(
                'label' => 'Nombre de billets',
                 'attr' => ['placeholder' =>"Vous pouvez réserver jusqu'à 10 tickets",  'min' => 1, 'max' => 10],
                 'required' => true,
                ))

            // integrer le date picker et les controles de vacances, feries et 1000 tickets
            ->add ('dateVisit', DateType::class, [
                'label' => 'Date de visite :',
                'widget' => 'single_text',
                ]
            )
            // 0 = demi journee et 1 journee
            ->add('duration', ChoiceType::class,  [
                'label' => 'Désirez-vous un billet journée ou demi-journée ?',
                'choices' => [
                    'Billet demi-journée' => true,
                    'Billet journée complète' => false,
                ]
            ])
            // verification des emails
            ->add('email', RepeatedType::class, [
                'type' => EmailType::class,
                'invalid_message' => 'The email fields must match',
                'options' => array('attr' =>array('class' =>'email-field')),
                'required' => true,
                'first_options' =>array('label' =>'email'),
                'second_options'=>array('label' =>'Repeat email'),
            ])
            // Generer un token
            ->add('token', HiddenType::class, [
            'data' =>'abcdef'
    ])
            ->add('tickets', CollectionType::class, [
                'entry_type' => TicketType ::class,
                'label_attr' => ['class'=>'hidden'],
                'allow_add' => true

            ])
            ->add('save', SubmitType::class);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
        {
            $resolver->setDefaults([
                'data_class' => 'AppBundle\Entity\Reservation'
            ]);
        }
}