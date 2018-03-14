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
use AppBundle\Form\TicketType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Reservation;
use AppBundle\Entity\Ticket;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;


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
     * @throws \Exception
     */
    public function organizeAction(Request $request)
    {
        $reservation = new Reservation();
        $form =$this->get('form.factory')->create(ReservationType :: class, $reservation);
        // recuperation du service
        $closingDay = $this->get('app.InvalidBookingDate');
        //  1. Verification que la requete est de type POST
        if($request->isMethod('POST'))
        {
            //  2. Recuperation des valeurs pour hydrater l'objet
            $form->handleRequest($request);
            $dateVisit = $reservation->getDateVisit();
            var_dump($dateVisit);

            if($closingDay->isClosing($dateVisit)) {
                throw new \Exception('Reservation Impossible');
          }
            if($closingDay->isPast($dateVisit)) {
                throw new \Exception('la date choisi est deja passé');
            }

            if($closingDay->isHalfDay($reservation)) {
                throw new \Exception('demi journee only');
            }
            // 3. Verification des valeurs et validation de l'objet
            if($form->isValid())
            {   //ouverture d'une session et on garde les infos en session
                $reservation = $form->getData();
                var_dump($reservation);
                $this->get('session')->set('reservation', $reservation);
                //redirection vers la page d'identification
                return $this->redirectToRoute('booking_identification');
            }
        }
        // Creation du formulaire
        return $this->render('AppBundle:Booking:organize.html.twig', ['form'=> $form->createView()]);
    }
    /**
     * Matches /identification
     * @route("/identification", name="booking_identification")
     */
    public function identificationAction(Request $request)
    {
        //recuperation des info de la page precedente
        $reservation = $request->getSession()->get('reservation');
        //formulaire ticket
        $ticket = new Ticket();
        $form=$this->get('form.factory')->create(TicketType::class, $ticket);
        if($request->isMethod('POST'))
        {
            $form->handleRequest($request);
            if($form->isValid())
            {
                $ticket = $form->getData();
                $this->get('session')->set('ticket', $ticket);
                return $this->redirectToRoute('booking_payment');
            }
        }
        return $this->render('AppBundle:Booking:identification.html.twig',
            ['reservation' => $reservation,
             'form'        => $form->createView(),
             ]
        );
    }
    /**
     * Matches /payment
     * @route("/payment", name="booking_payment")
     */
    public function paymentAction(Request $request)
    {
        $reservation = $request->getSession()->get('reservation');
        $ticket = $request->getSession()->get('ticket');
        return $this->render('AppBundle:Booking:payment.html.twig',[
            'reservation' => $reservation, 'ticket' => $ticket]);
    }
  }