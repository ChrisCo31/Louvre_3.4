<?php
/**
 * Created by PhpStorm.
 * User: mishi
 * Date: 07/04/2018
 * Time: 18:16
 */

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;

class PaymentType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // email
            ->add('email', EmailType::class, [

            ])
            // numéro carte bleue
            ->add('CBNumber', IntegerType::class, [

            ])
            // mois de validité carte bleue
            ->add('MonthValidity', IntegerType::class, [

            ])
            // année de validité carte bleue
            ->add('YearValidity', IntegerType::class, [

            ])
            // code carte bleue
            ->add('CVC', IntegerType::class, [

            ]);
    }
}