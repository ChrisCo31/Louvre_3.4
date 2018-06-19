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

use AppBundle\Form\PaymentType;
use AppBundle\Form\ReservationIdentifyType;
use AppBundle\Form\ReservationType;
use AppBundle\Form\TicketType;
use Swift_Mailer;
use Swift_SmtpTransport;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Reservation;
use AppBundle\Entity\Ticket;
use AppBundle\Entity\Transaction;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class BookingController extends Controller
{
    /**
     * Matches /
     * @route("/{_locale}", defaults={"_locale"="fr"}, requirements={
     *     "_locale"="en|fr"},name="booking_home")
     */
    public function indexAction(Request $request)
    {
        $locale = $request->getLocale();
        return $this->render('AppBundle:Booking:index.html.twig', array('locale' =>$locale));
    }
    /**
     * Matches /organisation
     * @route("/{_locale}/organisation", name="booking_organisation")
     * @throws \Exception
     */
    public function organizeAction(Request $request)
    {
        $locale = $request->getLocale();
        $reservation = new Reservation();
        $form = $this->createForm(ReservationType :: class, $reservation);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            // service qui va gerer la reservation
            $bookingManager = $this->get('app.BookingManager');
            // Methode qui place les donnees de la reservation dans une session
            $session = $bookingManager->saveReservation($reservation);
            $retrieve = $bookingManager->retrieveReservation($session);
            return $this->redirectToRoute('booking_identification');
        }
        return $this->render('AppBundle:Booking:organize.html.twig', ['locale' =>$locale, 'form'=> $form->createView()]);
    }
    /**
     * Matches /identification
     * @route("/{_locale}/identification", name="booking_identification")
     */
    public function identificationAction(Request $request)
    {
        $locale = $request->getLocale();
        $bookingManager = $this->get('app.BookingManager');
        $reservation = $bookingManager->retrieveReservation();
        // Flash Message
        $this->get('session')->getFlashBag()->add('warning', $this->get('translator')->trans('Warning.Flash.Identification'));
        //formulaire ticket a remplir
        if(!$reservation->hasAllTicket()) $bookingManager->generateTickets($reservation);
        $form = $this->createForm(ReservationIdentifyType::class, $reservation);
        //formulaire ticket rempli
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            // utilisation de la methode calculateTotalPrice du service PriceCalculator
            $totalPrice = $bookingManager->calculPrice($reservation);
            $ticket = $form->getData();
            $this->get('session')->set('ticket', $ticket);
            return $this->redirectToRoute('booking_payment');
        }
        return $this->render('AppBundle:Booking:identification.html.twig',
            ['reservation' => $reservation,
                'form'        => $form->createView(),
                'locale' =>$locale
            ]
        );
    }
    /**
     * Matches /payment
     * @route("/{_locale}/payment", name="booking_payment")
     */
    public function paymentAction(Request $request, Response $response = null)
    {
        $locale = $request->getLocale();
        $reservation = $request->getSession()->get('reservation');
        $tickets = $reservation->getTickets();
        $transaction = new Transaction();
        $reservation->setTransaction($transaction);
        if($request->isMethod('POST'))
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($reservation);
            $em->flush();
            $pay = $this->get('app.PayWithStripe');
            $pay->useStripe($request,$reservation, $transaction);
            $em = $this->getDoctrine()->getManager();
            $em->persist($reservation);
            $em->flush();
            if($transaction->getMessage("Transaction reussie"))
            {
                return $this->redirectToRoute('booking_success');
            }
        }
        return $this->render('AppBundle:Booking:payment.html.twig',[
            'reservation' => $reservation,
             'tickets' => $tickets,
            'locale' =>$locale
        ]);
    }
    /**
     * Matches /succes
     * @route("/{_locale}/succes", name="booking_success")
     */
    public function successAction(Request $request)
    {
        $locale = $request->getLocale();
        $reservation = $request->getSession()->get('reservation');
        return $this->render('AppBundle:Booking:success.html.twig',
            ['reservation' => $reservation,
              'locale' =>$locale
             ]
        );
    }
    /**
     * Matches /mentions
     * @route("/{_locale}/mentions", name="booking_mentions")
     */
    public function mentionsAction(Request $request)
    {
        $locale = $request->getLocale();
        return $this->render('AppBundle:Booking:mention.html.twig',
            ['locale' =>$locale]
        );
    }
}

