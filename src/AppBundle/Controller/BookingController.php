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
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;



class BookingController extends Controller
{
     /**
     * Matches /
     * @route("/", name="booking_home")
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
    }
    /**
     * Matches /organisation
     * @route("/organisation", name="booking_organisation")
     */
    public function organizeAction()
    {
        return $this->render('AppBundle:Booking:organize.html.twig');
    }
    /**
     * Matches /identification
     * @route("/identification", name="booking_identification")
     */
    public function identificationAction()
    {
        return new Response ("la page d'identification des futures visiteurs et la détermination du prix");
    }
    /**
     * Matches /payment
     * @route("/payment", name="booking_payment")
     */
    public function paymentAction()
    {
        return new Response ("la page de recap et d'appel de Stripe");
    }

  }