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
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
                'label' => 'Booking.Organize.Form.Nbticket',
                 'attr' => ['placeholder' =>"Booking.Organize.Ticketmax",  'min' => 1, 'max' => 10],
                 'required' => true,
                ))

            // integrer le date picker et les controles de vacances, feries et 1000 tickets
            ->add ('dateVisit', DateType::class, [
                    'label' => 'Booking.Organize.Date',
                    'format' => \IntlDateFormatter::SHORT,
                    'widget' => 'single_text',
                    'html5'=>false,
                    'attr'=>array('data-provide' => 'datepicker',
                        'format' => \IntlDateFormatter::SHORT,
                        'data-date-autoclose' => true,
                        'data-date-start-date' => '0d',
                        'data-date-days-of-week-disabled' => '0,2',
                        'data-date-days-of-week-highlighted' => '0,2',
                        'data-date-today-highlight' => true,
                        'data-date-week-start' => 1,
                        'data-date-end-date' => '+180d',
                    )
            ])

            // 0 = demi journee et 1 journee
            ->add('duration', ChoiceType::class,  [
                'label' => 'Booking.Organize.Duration',
                'choices' => [
                    'Booking.Organize.Half' => true,
                    'Booking.Organize.Full' => false,
                ]
            ])
            // verification des emails
            ->add('email', RepeatedType::class, [
                'type' => EmailType::class,
                'attr' => array('invalid_message' => 'Booking.Organize.Email') ,
                'options' => array('attr' =>array('class' =>'email-field')),
                'required' => true,
                'first_options' =>array('label' =>'Booking.Organize.Email'),
                'second_options'=>array('label' =>'Booking.Organize.Email.Rep'),
            ])
            // Generer un token
            ->add('token', HiddenType::class)

            ->add('suivant', SubmitType::class,[
                    'label' => 'Booking.Organize.Button',
                ]
               );
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