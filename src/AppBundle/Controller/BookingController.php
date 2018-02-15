<?php
/**
 * Created by PhpStorm.
 * User: mishi
 * Date: 14/02/2018
 * Time: 16:56
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;



class BookingController extends Controller
{
    /**
     * @return Response
     */
    public function indexAction(Request $request)
    {
        // Création d'une variable $langue
        $langue = NULL;
        // création du formulaire de choix de la langue
        $form = $this->createFormBuilder()
            ->add('langue', ChoiceType::class, array(
                'choices' => [
                    'english'=>'en',
                    'français' => 'fr',
                ]
            ))
            ->add('send', submitType::class, array('label'=>'Acheter mes billets en ligne'))
            ->getForm();
        // Traitement des donnees du form avec methode handleRequest
        $form->handleRequest($request);
        if($form->isValid())
        {
            $langue = $form['langue']->getData();
        }
        // ouverture d'une session
        // redirection vers la page "organize"
        // Informe la vue que l'on passe un formulaire
        return $this->render('AppBundle:Booking:index.html.twig', array('form' => $form -> createView(),
                                                                              'langue' => $langue,
        ));
    }

}