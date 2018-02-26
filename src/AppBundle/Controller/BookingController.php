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
use AppBundle\Entity\Reservation;
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
        $reservation = new Reservation();
        $form =$this->get('form.factory')->create(ReservationType :: class, $reservation);

        //  1. Verification que la requete est de type POST
        if($request->isMethod('POST'))
        {
            //  2. Recuperation des valeurs pour hydrater l'objet
            $form->handleRequest($request);

            // 3. Verification des valeurs et validation de l'objet
            if($form->isValid())
            {
                //ouverture d'une session et on garde les infos en session
                $reservation = $form->getData();
                var_dump($reservation);

                $this->get('session')->set('reservation', $reservation);
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
    public function identificationAction(Request $request)
    {
        $reservation = $request->getSession()->get('reservation');


        return $this->render('AppBundle:Booking:identification.html.twig', [
            'reservation' => $reservation,

        ]);
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