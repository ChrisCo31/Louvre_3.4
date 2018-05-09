<?php
/**
 * Created by PhpStorm.
 * User: mishi
 * Date: 01/03/2018
 * Time: 07:31
 */

namespace AppBundle\Form;



use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TicketType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('firstName', TextType::class, array(
            'label' => 'Booking.Identification.Firstname',
            'required' => true
        ))
        ->add('lastName', TextType::class, array(
            'label' => 'Booking.Identification.Lastname',
            'required' => true
        ))
        ->add('birthDate', BirthdayType::class, array(
            'label' => 'Booking.Identification.Birthdate',
            'format' => 'dd-MM-yyyy',
            'widget' => 'single_text',
             'attr' => ['placeholder' =>"Booking.Identification.Date"],
        ))
        ->add('country', CountryType::class, array(
            'label' => 'Booking.Identification.Country',
            'preferred_choices' => array(
                'France' => 'FR'
            )))
        ->add('discount', CheckboxType::class, array(
            'label' => 'Booking.Identification.Discount',
            'required' => false
        ));

    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
        {
            $resolver->setDefaults([
                'data_class' => 'AppBundle\Entity\Ticket'
            ]);
        }
}
