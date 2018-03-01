<?php
/**
 * Created by PhpStorm.
 * User: mishi
 * Date: 01/03/2018
 * Time: 07:31
 */

namespace AppBundle\Form;


use function Sodium\add;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

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
            'label' => 'firstName',
            'required' => true
        ))
        ->add('lastName', TextType::class, array(
            'label' => 'lastName',
            'required' => true
        ))
        ->add('birthDate', BirthdayType::class, array(
            'format' => 'dd-MM-yyyy',
            'widget' => 'single_text'
        ))
        ->add('country', CountryType::class, array(
            'label' => 'country',
            'placeholder' => 'choisissez votre pays',
            'preferred_choices' => array(
                'France' => 'FR'
            )))
        ->add('discount', CheckboxType::class, array(
            'label' => 'tarif reduit',
            'required' => false
        ))
        ->add('price', TextType::class)
        ->add('Ajouter', SubmitType::class);

    }

}