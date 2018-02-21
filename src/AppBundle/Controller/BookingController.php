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

use AppBundle\Form\ReservationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
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
        $locale = $request->getLocale();
        return $this->render('AppBundle:Booking:index.html.twig', array('locale' =>$locale));
    }
    /**
     * Matches /organisation
     * @route("/organisation", name="booking_organisation")
     */
    public function organizeAction(Request $request)
    {
        //  1. Verification que la requete est de type POST
        if($request->isMethod('POST'))
        {
            //  2. Recuperation des valeurs pour hydrater l'objet
            //$form->handleRequest($this->getRequest());

            // 3. Verification des valeurs et validation de l'objet
            //if($form->isValid() && $form->isSubmitted())
            {
                //ouverture d'une session et on garde les infos en session
                $session = new Session();
                $session->set('info', array());
                var_dump($session);
                exit();


                //redirection vers la page d'identification
                return $this->redirectToRoute('booking_identification');
            }
        }
        // Creation du formulaire
        $form = $this->get('form.factory')->create(ReservationType::class);
        return $this->render('AppBundle:Booking:organize.html.twig', ['form'=> $form->createView()]);
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