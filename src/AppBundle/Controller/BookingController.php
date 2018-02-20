<?php
/**
 * Created by PhpStorm.
 * User: mishi
 * Date: 14/02/2018
 * Time: 16:56
 */

namespace AppBundle\Controller;

use AppBundle\Form\ReservationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class BookingController extends Controller
{
    /**
     * Matches /
     * @route("/", name="booking_home")
     */
    public function indexAction(Request $request)
    {
        return $this->render('AppBundle:Booking:index.html.twig');
    }
    /**
     * Matches /organisation
     * @route("/organisation", name="booking_organisation")
     */
    public function organizeAction(Request $request)
    {
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