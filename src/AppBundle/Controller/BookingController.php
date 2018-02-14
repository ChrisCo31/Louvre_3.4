<?php
/**
 * Created by PhpStorm.
 * User: mishi
 * Date: 14/02/2018
 * Time: 14:56
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BookingController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Booking:index.html.twig');
    }

    /**
     * @return Response
     */
    public function organizeAction()
    {
        return $this->render('AppBundle:Booking:organize.html.twig');
    }

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
