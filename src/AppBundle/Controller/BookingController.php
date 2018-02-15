<?php
/**
 * Created by PhpStorm.
 * User: mishi
 * Date: 14/02/2018
<<<<<<< HEAD
 * Time: 14:56
=======
 * Time: 16:56
>>>>>>> test
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
<<<<<<< HEAD
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
=======
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


>>>>>>> test

class BookingController extends Controller
{
    /**
<<<<<<< HEAD
     * @param Request $request
     * @return Response
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Booking:index.html.twig');
=======
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
        // si la requete est en POST
        if($request->isMethod('POST'))
        {
            // Traitement des donnees du form avec methode handleRequest
            $form->handleRequest($request);

            if($form->isValid())
            {
                // ouverture d'une session
                // redirection vers la page "organize"
                return $this->redirectToRoute('booking_organisation');
            }
        }
            // Informe la vue que l'on passe un formulaire
            return $this->render('AppBundle:Booking:index.html.twig', ['form' => $form -> createView(),
                                                                                 'langue' => $langue,
            ]);
>>>>>>> test
    }

    /**
     * @return Response
     */
    public function organizeAction()
    {
        return $this->render('AppBundle:Booking:organize.html.twig');
    }
<<<<<<< HEAD

    /**
     * @return Response
     */
    public function identificationAction()
    {
        return new Response ("la page d'identification des futures visiteurs et la détermination du prix");
    }

    public function paymentAction()
    {
        return new Response ("la page de recap et d'appel de Stripe");
    }
}
=======
}
>>>>>>> test
